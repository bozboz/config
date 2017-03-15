<?php

namespace Bozboz\Config\Providers;

use Bozboz\Config\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\QueryException;

class SiteConfig extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        if (! $this->app->routesAreCached()) {
            require __DIR__.'/../Http/routes.php';
        }

        $this->registerPermissions();
        $this->adminMenu();

        $this->app->singleton('siteConfig', function($app) {
            return new Config;
        });

        $this->app->instance(Config::class, $this->app['siteConfig']);

        $this->publishes([
            __DIR__.'/../../database/migrations/' => database_path('migrations')
        ], 'migrations');

        $this->loadViewsFrom(__DIR__."/../../resources/views", 'site-config');

        view()->share('config', $this->app['siteConfig']);
    }

    protected function registerPermissions()
    {
        $this->app['permission.handler']->define([

            'view_site_config' => 'Bozboz\Permissions\Rules\Rule',
            'create_site_config' => 'Bozboz\Permissions\Rules\Rule',
            'delete_site_config' => 'Bozboz\Permissions\Rules\Rule',
            'edit_site_config' => 'Bozboz\Permissions\Rules\Rule',

        ]);
    }

    protected function adminMenu()
    {
        $this->app['events']->listen('admin.renderMenu', function($menu)
        {
            if ($menu->gate('view_site_config')) {
                $menu->appendToItem('Config', ['Config' => 'admin.config.index']);
            }
        }, -1);
    }
}