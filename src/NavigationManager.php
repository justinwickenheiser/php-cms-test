<?php

namespace GvsuWebTeam\Cms;
use Illuminate\Support\Str;

use GvsuWebTeam\Cms\Models\Site;

class NavigationManager
{
	protected $query;
	protected $placement = 'horizontal';

	public function __construct(?Site $site = null)
	{
        if ($site) {
			$this->query = $site->navigation ?? collect([]);
			$this->placement = $site->navigationType ?? $this->placement;
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