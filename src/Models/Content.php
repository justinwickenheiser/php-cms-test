<?php

namespace GvsuWebTeam\Cms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use GvsuWebTeam\Cms\Http\Traits\OverrideTrait;

class Content extends Model
{
    use HasFactory, SoftDeletes, OverrideTrait;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'cms_content';

	/**
     * The model's default values for attributes.
     *
     * @var array
     */
	protected $attributes = [
		'is_internal' => false,
		'is_homepage' => false,
		'show_problem' => true,
		'id' => '',
		'title' => '',
		'slug' => '',
		'description' => '',
		'meta_title' => '',
		'start_date' => '',
		'end_date' => '',
		'updated_at' => '',
		'created_at' => '',
		'header' => [],
		'header_type' => 'default',
		'admin' => ''
	];

	 /**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'site_id',
		'title',
		'slug',
		'is_homepage',
		'is_internal',
		'show_problem',
		'description',
		'meta_title',
		'start_date',
		'end_date',
		'header_type',
		'admin',
		'content'
	];

	/**
	* Get the site associated with the content.
	*/
	public function site()
	{
		return $this->belongsTo( Site::class)->withDefault();
	}
}
