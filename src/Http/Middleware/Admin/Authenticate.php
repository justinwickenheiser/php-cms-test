<?php

namespace GvsuWebTeam\Cms\Http\Middleware\Admin;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Closure;

class Authenticate extends Middleware
{

	/**
	 * Get the path the user should be redirected to when they are not authenticated.
	 */
	protected function redirectTo(Request $request): ?string
	{
		return $request->expectsJson() ? null : route('cms.admin.login');
	}
}
