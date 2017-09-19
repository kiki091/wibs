<?php

namespace App\Repositories\Contracts\Msc;


interface ReportTahfidz
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
    public function getAll($params);

} 