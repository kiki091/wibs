<?php

namespace App\Services\Bridge\Auth\Pages;

use App\Repositories\Contracts\Auth\Pages\ReportHadis as ReportHadisInterface;

class ReportHadis {

    /**
     * @var ReportHadisInterface
     */
    protected $reportHadis;

    public function __construct(ReportHadisInterface $reportHadis)
    {
        $this->reportHadis = $reportHadis;
    }
    
    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->reportHadis->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->reportHadis->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->reportHadis->edit($params);
    }

} 