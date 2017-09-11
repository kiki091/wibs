<?php

namespace App\Services\Bridge\Auth\Pages;

use App\Repositories\Contracts\Auth\Pages\ReportKesehatan as ReportKesehatanInterface;

class ReportKesehatan {

    /**
     * @var ReportKesehatanInterface
     */
    protected $reportKesehatan;

    public function __construct(ReportKesehatanInterface $reportKesehatan)
    {
        $this->reportKesehatan = $reportKesehatan;
    }
    
    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->reportKesehatan->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->reportKesehatan->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->reportKesehatan->edit($params);
    }

} 