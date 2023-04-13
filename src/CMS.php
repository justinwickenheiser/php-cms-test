<?php

namespace GvsuWebTeam\Cms;

use Illuminate\Support\Str;
use GvsuWebTeam\Cms\Models\Site;
use GvsuWebTeam\Cms\Models\Content;

class CMS
{
	/**
	 * 
	 * @var Site
	 */
	protected $site;

	/**
	 * 
	 * @var Content
	 */
	protected $page;

	/**
	 * 
	 * @var NavigationManager
	 */
	protected $navigation;

	public function __construct()
	{
		$route = app()->router->current();

		if (array_key_exists('site', $route->parameters)) {
			$site = $route->parameters['site'];
		} else {
			$uri = (explode('/', $route->uri));
			// Check for CMS admin
			if ($uri[0] === 'cms5') {
				// check for reserved admin words
				if ( in_array($uri[1], config('cms.admin.route-reserved-words') ) ) {
					// not accessing a site
					$slug = null;
				} else {
					// This might never be hit.
					dd("no Site found in the CMS.php file");
					// $slug = $uri[1];
				}
			} else {
				// This could be the site for custom features defined in package route files.
				// e.g. /webteam/policies -> (defined in gvsu-web-team/webteam package route file)
				$slug = $uri[0];
			}
			$site =  Site::where('path', $slug)->firstOrNew(); 
		}

		if (array_key_exists('content', $route->parameters)) {
			$page = $route->parameters['content'];
		} else if ($route->getName() === 'cms.public.content.homepage') {
			$page = $site->contents->where('is_homepage', 1)->first();
		} else {
			$page = new Content();
		}

		$this->site = $site;
		$this->page = $page;
		$this->navigation = new NavigationManager( get_class($site) === 'GvsuWebTeam\Cms\Models\Site' ? $site : null );
	}

	/**
	 * Dynamically property accesstor.
	 *
	 * @param string $property
	 *
	 * @return mixed
	 */
	public function __get($property)
	{
		$getter = Str::camel('get_' . $property);

		if (method_exists($this, $getter)) {
			return call_user_func_array([$this, $getter], []);
		}

		return $this->{$property};
	}

	public function get() {
		return $this;
	}
	public function site($overrides = null): Site {
		if ($overrides) {
			// Site::setOverrides( [] )
			$this->site->setOverrides($overrides);
		}
		return $this->site;
	}
	public function page($overrides = null): Content {
		if ($overrides) {
			// Content::setOverrides( [] )
			$this->page->setOverrides($overrides);
		}
		return $this->page;
	}
	public function navigation() {
		return $this->navigation;
	}
	
	public function pageSize() {
		return 25;
	}
	public function getCustomMenu() {

		if ( config($this->site->path) && config($this->site->path)['cms'] ) {
			return config($this->site->path)['cms']['custom'] ?? [];
		}

		return [];
	}

}