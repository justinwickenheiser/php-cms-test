<?php

namespace GvsuWebTeam\Cms\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $root = __DIR__.'/../..';

    protected $configFiles = [
        'admin', 'auth', 
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom($this->root . '/database/migrations');
        $this->loadRoutesFrom($this->root . '/routes/routes.php');

        $this->loadViewsFrom($this->root . '/resources/views', 'cms');

        collect($this->configFiles)->each(function ($config) {
            $this->publishes(["{$this->root}/config/$config.php" => config_path("cms/$config.php")], 'cms');
        });

        $this->publishes([
            $this->root . '/public' => public_path('vendor/gvsu-web-team/cms'),
        ], 'cms-public');
        
    }    

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        collect($this->configFiles)->each(function ($config) {
            $this->mergeConfigFrom("{$this->root}/config/$config.php", "cms.$config");
        });

        // Register facades
        $this->app->singleton('cms', function () {
            return new \GvsuWebTeam\Cms\CMS;
        });
        $this->app->singleton('cms.content', function () {
            return new \GvsuWebTeam\Cms\Models\Content;
        });
        
    }
}
