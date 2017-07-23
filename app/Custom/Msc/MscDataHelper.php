<?php

namespace App\Custom\Msc;

use Session;

class MscDataHelper {

    const DEFAULT_SYSTEM_LOCATION = 'CONTENT MANAGEMENT SYSTEM';
    /**
     * Get siswa Info
     */
    public static function siswaInfo()
    {
        return Session::get('siswa_info');
    }

    /**
     * Get siswa Id
     */

    public static function siswaId()
    {
        $siswaInfo = Session::get('siswa_info');

        if (isset($siswaInfo['siswa_id'])) {
            return $siswaInfo['siswa_id'];
        }

        return false;
    }

	/**
     * Get siswa Email
     */
    public static function siswaEmail()
    {
        $siswaInfo = Session::get('siswa_info');

        if (isset($siswaInfo['email'])) {
            return $siswaInfo['email'];
        }

        return false;
    }

    /**
     * Get siswa Name
     */

    public static function siswaName()
    {
        $siswaInfo = Session::get('siswa_info');

        if (isset($siswaInfo['nama_lengkap'])) {
            return $siswaInfo['nama_lengkap'];
        }

        return false;
    }

    /**
     * Get siswa Role
     */
    public static function siswaRole()
    {
        $siswaInfo = Session::get('siswa_info');

        if (isset($siswaInfo['siswa_privilage']['role_name'])) {

            return $siswaInfo['siswa_privilage']['role_name'];
        }

        return false;
    }

    /**
     * Get siswa Menu
     */

    public static function siswaMenu()
    {
        $siswaInfo = Session::get('siswa_info');

        if (isset($siswaInfo['siswa_menu'])) {
            return $siswaInfo['siswa_menu'];
        }

        return false;
    }

    /**
     * Get siswa Menu
     */

    public static function siswaLocation()
    {
        $siswaInfo = Session::get('siswa_info');

        if (isset($siswaInfo['siswa_location']['slug'])) {
            return $siswaInfo['siswa_location']['slug'];
        }

        return false;
    }
}