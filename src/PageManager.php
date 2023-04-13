<?php

namespace GvsuWebTeam\Cms;
use Illuminate\Support\Str;
use GvsuWebTeam\Cms\Models\Content;

class PageManager
{
	protected $is_internal;
	protected $is_homepage;
	protected $show_problem;
	protected $id;
	protected $title;
	protected $slug;
	protected $description;
	protected $meta_title;
	protected $start_date;
	protected $end_date;
	protected $updated_at;
	protected $created_at;
	protected $header = [];
	protected $header_type;
	protected $admin;

	public function __construct(?Content $content = null)
	{
		if ($content) {
			$this->is_internal = $content->is_internal;
			$this->is_homepage = $content->is_homepage;
			$this->show_problem = $content->show_problem;
			$this->id = $content->id;
			$this->title = $content->title;
			$this->slug = $content->slug;
			$this->description = $content->description;
			$this->meta_title = $content->meta_title;
			$this->start_date = $content->start_date;
			$this->end_date = $content->end_date;
			$this->updated_at = $content->updated_at;
			$this->created_at = $content->created_at;
			// $this->header = [];
			$this->header_type = $content->header_type;
			$this->admin = $content->admin;
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