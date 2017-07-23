<?php

namespace App\Services\Bridge\Msc;

use App\Repositories\Contracts\Msc\StudentMonitoring as StudentMonitoringInterface;

class StudentMonitoring {

    /**
     * @var Report Kesehatan Interface
     */
    protected $studentMonitoring;

    public function __construct(StudentMonitoringInterface $studentMonitoring)
    {
        $this->studentMonitoring = $studentMonitoring;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->studentMonitoring->getData($params);
    }

} 