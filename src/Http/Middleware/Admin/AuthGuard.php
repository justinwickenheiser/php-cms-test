<?php

namespace GvsuWebTeam\Cms\Http\Middleware\Admin;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthGuard
{
    public function handle($request, Closure $next)
    {
        Auth::shouldUse(config('cms.auth.guards.admin', 'cms_admin'));

        return $next($request);
    }
}