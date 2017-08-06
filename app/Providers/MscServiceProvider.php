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
        $this->app->bind('App\Repositories\Contracts\Msc\StudentMonitoring', 'App\Repositories\Implementation\Msc\StudentMonitoring');
        $this->app->bind('App\Repositories\Contracts\Msc\QuranRecitationReport', 'App\Repositories\Implementation\Msc\QuranRecitationReport');

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
            'App\Repositories\Contracts\Msc\StudentMonitoring',
            'App\Repositories\Contracts\Msc\QuranRecitationReport',
        );
    }
}
