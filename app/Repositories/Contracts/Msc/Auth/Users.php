<?php

namespace App\Repositories\Contracts\Msc\Auth;


interface Users
{

    /**
     * @param $params
     * @return mixed
     */
    public function setAuthSession($params);

    /**
     * @param $params
     * @return mixed
     */
    public function changePassword($params);

    /**
     * @param $params
     * @return mixed
     */
    public function store($params);

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params);


} 