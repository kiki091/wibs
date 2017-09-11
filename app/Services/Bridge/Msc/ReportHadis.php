<?php

namespace App\Services\Bridge\Msc;

use App\Repositories\Contracts\Msc\ReportHadis as ReportHadisInterface;

class ReportHadis {

    /**
     * @var Report Hadis Interface
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

} 