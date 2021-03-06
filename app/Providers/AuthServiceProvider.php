<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
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

        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\Contracts\Auth\Users', 'App\Repositories\Implementation\Auth\Users');
        $this->app->bind('App\Repositories\Contracts\Auth\MenuGroup', 'App\Repositories\Implementation\Auth\MenuGroup');
        $this->app->bind('App\Repositories\Contracts\Auth\MenuNavigation', 'App\Repositories\Implementation\Auth\MenuNavigation');
        $this->app->bind('App\Repositories\Contracts\Auth\SubMenuNavigation', 'App\Repositories\Implementation\Auth\SubMenuNavigation');
        $this->app->bind('App\Repositories\Contracts\Auth\Privilage', 'App\Repositories\Implementation\Auth\Privilage');
        $this->app->bind('App\Repositories\Contracts\Auth\System', 'App\Repositories\Implementation\Auth\System');
        $this->app->bind('App\Repositories\Contracts\Auth\Location', 'App\Repositories\Implementation\Auth\Location');


        $this->app->bind('App\Repositories\Contracts\Auth\Pages\Kitab', 'App\Repositories\Implementation\Auth\Pages\Kitab');
        $this->app->bind('App\Repositories\Contracts\Auth\Pages\Santri', 'App\Repositories\Implementation\Auth\Pages\Santri');
        $this->app->bind('App\Repositories\Contracts\Auth\Pages\WaliSiswa', 'App\Repositories\Implementation\Auth\Pages\WaliSiswa');
        $this->app->bind('App\Repositories\Contracts\Auth\Pages\ReportQuran', 'App\Repositories\Implementation\Auth\Pages\ReportQuran');
        $this->app->bind('App\Repositories\Contracts\Auth\Pages\ReportKesehatan', 'App\Repositories\Implementation\Auth\Pages\ReportKesehatan');
        $this->app->bind('App\Repositories\Contracts\Auth\Pages\ReportHadis', 'App\Repositories\Implementation\Auth\Pages\ReportHadis');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array(
            'App\Repositories\Contracts\Auth\Users',
            'App\Repositories\Contracts\Auth\MenuGroup',
            'App\Repositories\Contracts\Auth\MenuNavigation',
            'App\Repositories\Contracts\Auth\SubMenuNavigation',
            'App\Repositories\Contracts\Auth\Privilage',
            'App\Repositories\Contracts\Auth\System',
            'App\Repositories\Contracts\Auth\Location',

            
            'App\Repositories\Contracts\Auth\Pages\Kitab',
            'App\Repositories\Contracts\Auth\Pages\Santri',
            'App\Repositories\Contracts\Auth\Pages\WaliSiswa',
            'App\Repositories\Contracts\Auth\Pages\ReportQuran',
            'App\Repositories\Contracts\Auth\Pages\ReportKesehatan',
            'App\Repositories\Contracts\Auth\Pages\ReportHadis',
        );
    }
}
