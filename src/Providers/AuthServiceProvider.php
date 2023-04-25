<?php

namespace GvsuWebTeam\Cms\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /*
    | This method for adding to the config.auth via a package was done
    | in Laravel/Sanctum which was required by default when creating the app.
    | If it is good enough for Laravel to do, it we can do it too.
    |
    | https://github.com/laravel/sanctum/blob/121a2c3b7af9cb36a57d4413c80f63274b7532a0/src/SanctumServiceProvider.php
    |
    */
    public function register()
    {
    	config([
            'auth.guards.cms_admin' => array_merge([
                'driver' => 'session',
                'provider' => 'cms_admins',
            ], config('auth.guards.cms_admin', [])),
        ]);

        config([
            'auth.providers.cms_admins' => array_merge([
                'driver' => 'eloquent',
                'model' => \GvsuWebTeam\Cms\Models\User::class,
            ], config('auth.providers.cms_admins', [])),
        ]);
    }

}
