<?php

namespace App\Providers;


use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class MscServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
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
        $this->app->bind('App\Repositories\Contracts\Msc\ReportHealth', 'App\Repositories\Implementation\Msc\ReportHealth');
        $this->app->bind('App\Repositories\Contracts\Msc\ReportTahfidz', 'App\Repositories\Implementation\Msc\ReportTahfidz');
        $this->app->bind('App\Repositories\Contracts\Msc\ReportHadis', 'App\Repositories\Implementation\Msc\ReportHadis');

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
            'App\Repositories\Contracts\Msc\ReportHealth',
            'App\Repositories\Contracts\Msc\ReportTahfidz',
            'App\Repositories\Contracts\Msc\ReportHadis',
        );
    }
}
