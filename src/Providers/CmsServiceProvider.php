<?php

namespace GvsuWebTeam\Cms\Providers;

use Illuminate\Support\ServiceProvider;

class CmsServiceProvider extends ServiceProvider
{
    /**
     * The provider class names.
     *
     * @var array
     */
    protected $providers = [
        AppServiceProvider::class,
        AuthServiceProvider::class,
		AdminServiceProvider::class,
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }
    }
}