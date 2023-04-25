<?php

namespace GvsuWebTeam\Cms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use GvsuWebTeam\Cms\Http\Traits\OverrideTrait;

class Site extends Model
{
    use HasFactory, SoftDeletes, OverrideTrait;

    /**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'cms_site';

	/**
     * The model's default values for attributes.
     *
     * @var array
     */
	protected $attributes = [
		'id' => '',
		'title' => '',
		'path' => '',
		'sub_version' => '',
		'description' => '',
		'show_title' => true,
		'show_content_title' => true
	];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id',
		'title',
		'path',
		'sub_version',
		'description',
		'show_title',
		'show_content_title'
	];

	/**
	 * Get the content pages associated with the site.
	 */
	public function contents()
	{
		return $this->hasMany(Content::class);
	}
}
