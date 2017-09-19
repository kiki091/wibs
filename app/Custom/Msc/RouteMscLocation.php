<?php

namespace App\Custom\Msc;

use LaravelLocalization;
use Request;
use App\Redis\MenuLocation as MenuLocationRedis;
use App\Models\Msc\Siswa as SiswaModels;
use App\Models\Msc\Tingkatan as TingkatanModels;
use Cache;
use Session;
use Auth;
use Route;

class RouteMscLocation {

	const DEFAULT_USER_MSC_MENU = 'smp';
    const DEFAULT_USER_MSC_SLUG = 'santri';

	/**
     * Set Menu Location
     * @return null
     */
    public function setUserMscLocation()
    {
        
        $menuLocation = Request::segment(1);

        $redisKey                   = MenuLocationRedis::MSC_MENU_COLLECTION;
        $menuLocationCollection     = Cache::rememberForever($redisKey, function() {

            return TingkatanModels::where('is_active',true)->get()->toArray();

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

            Session::forget('current_msc_menu_location');

            $this->setSessionCurrentMenuLocation('');

            return self::DEFAULT_USER_MSC_MENU;
        }


        $this->setSessionCurrentMenuLocation($menuLocation);

        return $menuLocation;
    }

    /**
     * Set Menu Location
     * @return null
     */
    public function setUsernameMscToSlug()
    {
        
        $userSlug = Request::segment(1);
        $menuLocationCollection =  SiswaModels::where('is_active',true)->get()->toArray();
        
        if(empty($menuLocationCollection))
            return null;

        foreach ($menuLocationCollection as $key => $value) {
           
            if(strtolower(str_slug($value['nama_lengkap'])) == $userSlug) {
                $isExists = true;
                break;
            }
            $isExists = false;
        }

        if(!$isExists) {

            Session::forget('current_msc_menu_location');

            $this->setSessionCurrentUserSlug('');

            return self::DEFAULT_USER_MSC_SLUG;
        }


        $this->setSessionCurrentUserSlug($userSlug);

        return $userSlug;
    }

    /**
     * Set Session Current Menu
     * @param $param
     */
    public function setSessionCurrentMenuLocation($param)
    {
        Session::forget('current_msc_menu_location');
        Session::put('current_msc_menu_location', $param);
    }

    /**
     * Set Session Current Menu
     * @param $param
     */
    public function setSessionCurrentUserSlug($param)
    {
        Session::forget('current_msc_user_slug');
        Session::put('current_msc_user_slug', $param);
    }

}