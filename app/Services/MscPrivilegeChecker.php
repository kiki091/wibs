<?php

namespace App\Services;

use Route;
use Auth;
use Config;
use Session;
use App\Custom\Msc\DataHelper;
use Symfony\Component\VarDumper\Cloner\Data;

class MscPrivilegeChecker
{
    /**
     * A collection of role
     *
     * @access protected
     * @var    role
     */
    protected $role;


    /**
     * Is Public Method
     *
     * @var bool
     */
    protected $isPublicMethod = false;

    /**
     * public Method
     * @var array
     */
    protected $publicMethod = [
        'App\Http\Controllers\Wibs\Msc\Pages\DashboardMscController@index'
    ];

    /**
     * Initiate some mandatory properties.
     *
     * @access public
     * @param  array    $role
     * @param  int      $system
     * @param  string   $controller
     * @param  string   $method
     */
    public function __construct($role = null)
    {
        if ($role == null)
        {
            $session = Session::get('siswa_info');

            $role = isset($session['siswa_privilage']['role_name']) ? $session['siswa_privilage']['role_name'] : null;

        }

        $currentRoute = Route::currentRouteAction();

        $routeAction = explode('@', $currentRoute);

        if (in_array($currentRoute, $this->publicMethod)) {
            $this->isPublicMethod = true;
        }

        $this->role   = $role;
    }

    /**
     * Check whether the administrator is authorized to access certain methods
     *
     * @access public
     * @return bool
     */
    public function isAuthorized()
    {
        if ($this->isPublicMethod === true) {
            return true;
        }

        if (! isset($this->role)) {
            return false;
        }


        return true;
    }
}