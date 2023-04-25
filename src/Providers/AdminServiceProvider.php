<?php

namespace GvsuWebTeam\Cms\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    protected $root = __DIR__.'/../..';


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerMiddlewareGroups();
    }    

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {   
    }

    protected function registerMiddlewareGroups()
    {
        $router = $this->app->make(Router::class);

        $router->middlewareGroup('cms.admin', [
            // AuthGuard will have the requests under this middleware use guard 'cms_admin' by default
            // That allows simply using Auth::* instead of Auth::guard('cms_admin') every time.
            \GvsuWebTeam\Cms\Http\Middleware\Admin\AuthGuard::class,
        ]);

        $router->middlewareGroup('cms.admin.authenticated', [
            // \Statamic\Http\Middleware\CP\Authorize::class,
            // \Statamic\Http\Middleware\CP\Localize::class,
            // \Statamic\Http\Middleware\CP\BootPermissions::class,
            // \Statamic\Http\Middleware\CP\BootPreferences::class,
            // \Statamic\Http\Middleware\CP\BootUtilities::class,
            // \Statamic\Http\Middleware\CP\CountUsers::class,
            // \Statamic\Http\Middleware\DeleteTemporaryFileUploads::class,
        ]);

        /* 
        | Specify the :cms_admin guard to use with the Authenticate class, because
        | for some reason it isn't picking up on it even when the cms.admin group is
        | grouping the route that calls the middleware.
        */
        $router->aliasMiddleware('cms.admin.auth', \GvsuWebTeam\Cms\Http\Middleware\Admin\Authenticate::class.':cms_admin');
    }
}
