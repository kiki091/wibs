<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Custom\Msc\RouteMscLocation;

class RouteMscLocationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('RouteMscLocation', function () {
            return new RouteMscLocation;
        });
    }
}
