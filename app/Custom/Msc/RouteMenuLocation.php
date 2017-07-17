<?php

namespace App\Custom\Msc;

use LaravelLocalization;
use Request;
use App\Redis\MenuLocation as MenuLocationRedis;
use App\Models\Msc\Auth\Location as LocationModels;
use Cache;
use Session;
use Auth;
use Route;

class RouteMenuLocation {

    const DEFAULT_MENU = '/';
	const DEFAULT_USER_SMP_MENU = 'smp';
    const DEFAULT_USER_SMA_MENU = 'sma';
    const DEFAULT_USER_MENU = 'user';
    const DEFAULT_ADMIN_MENU = 'account';

	/**
     * Set Menu Location
     * @return null
     */
    public function setMenuLocation()
    {
        
        $menuLocation = Request::segment(1);

        $redisKey                   = MenuLocationRedis::MENU_LOCATION;
        $menuLocationCollection     = Cache::rememberForever($redisKey, function() {

            return LocationModels::where('is_active',true)->get()->toArray();

        });
        
        if(empty($menuLocationCollection))
            return null;

        foreach ($menuLocationCollection as $key => $value) {
           
            if($value['slug'] == $menuLocation) {
                $isExists = true;
                break;
            }
            $isExists = false;
        }

        if(!$isExists) {

            Session::forget('current_menu_location');

            $this->setSessionCurrentMenuLocation('');

            return self::DEFAULT_USER_SMP_MENU;
        }


        $this->setSessionCurrentMenuLocation($menuLocation);

        return $menuLocation;
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