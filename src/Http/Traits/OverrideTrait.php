<?php
namespace GvsuWebTeam\Cms\Http\Traits;

trait OverrideTrait {

	public function setOverrides($settings) {
		collect($settings)->each(function($val, $key) {
			$this->$key = $val;
		});
	}
}