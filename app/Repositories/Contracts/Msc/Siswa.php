<?php

namespace App\Repositories\Contracts\Msc;


interface Siswa
{

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params);

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params);

    /**
     * @param $params
     * @return mixed
     */
    public function store($params);


    /**
     * @param $params
     * @return mixed
     */
    public function changePassword($params);


} 