<?php

namespace App\Services\Bridge\Msc;

use App\Repositories\Contracts\Msc\ReportTahfidz as ReportTahfidzInterface;

class ReportTahfidz {

    /**
     * @var Report Kesehatan Interface
     */
    protected $reportTahfidz;

    public function __construct(ReportTahfidzInterface $reportTahfidz)
    {
        $this->reportTahfidz = $reportTahfidz;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->reportTahfidz->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getAll($params = array())
    {
        return $this->reportTahfidz->getAll($params);
    }

} 