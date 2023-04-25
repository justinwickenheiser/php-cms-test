<?php

namespace GvsuWebTeam\Cms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes;

    /**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'cms_user';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id' => '',
		'first_name' => '',
		'last_name' => '',
		'username' => '',
		'email' => ''
	];
}
