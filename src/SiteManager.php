<?php

namespace GvsuWebTeam\Cms;
use Illuminate\Support\Str;
use GvsuWebTeam\Cms\Models\Site;

class SiteManager
{

	/**
	 * The CMS site's subversion (i.e. 4.2 = 2)
	 *
	 * @var integer
	 */
	protected $subVersion = 0;

	/**
	 * The CMS site's title
	 *
	 * @var string
	 */
	protected $title;

	/**
	 * Determine whether to display site's title on content pages
	 *
	 * @var bool
	 */
	protected $showTitle = true;

	/**
	 * The CMS site's path
	 *
	 * @var string
	 */
	protected $path;

	/**
	 * The CMS site's description
	 *
	 * @var string
	 */
	protected $description;

	/**
	 * The CMS site's navigationType
	 *
	 * @var string
	 */
	protected $navigationType = 'horizontal';

	public function __construct(?Site $site = null)
	{
		if ($site) {
			$this->title = $site->title;
			$this->path = $site->path;
		}
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

}