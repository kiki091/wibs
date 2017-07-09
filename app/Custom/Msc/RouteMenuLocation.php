<?php

namespace App\Custom\Msc;

use LaravelLocalization;
use Request;
use App\Models\Msc\Auth\Location as LocationModels;
use Cache;
use Session;
use Auth;
use Route;

class RouteMenuLocation {

    const DEFAULT_MENU = '/';
	const DEFAULT_USER_MENU = 'user';
    const DEFAULT_ADMIN_MENU = 'admin';

	/**
     * Set Menu Location
     * @return null
     */
    public function setMenuLocation()
    {
        

    }

    /**
    * Get Session Menu Location List
    * @return array
    */
    public function getSessionMenuLocationList()
    {   
        
    }

    /**
     * Set Session Current Menu
     * @param $param
     */
    public function setSessionCurrentMenuLocation($param)
    {
        Session::forget('current_menu_location');
        Session::put('current_menu_location', $param);
    }

}