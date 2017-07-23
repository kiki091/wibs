<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MscServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // AUTH
        $this->app->bind('App\Repositories\Contracts\Msc\Auth\Siswa', 'App\Repositories\Implementation\Msc\Auth\Siswa');

        // PAGES
        $this->app->bind('App\Repositories\Contracts\Msc\Siswa', 'App\Repositories\Implementation\Msc\Siswa');

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array(

            'App\Repositories\Contracts\Msc\Auth\Siswa',
            'App\Repositories\Contracts\Msc\Siswa',
        );
    }
}
