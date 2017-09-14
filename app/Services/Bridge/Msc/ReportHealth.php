<?php

namespace App\Services\Bridge\Msc;

use App\Repositories\Contracts\Msc\ReportHealth as ReportHealthInterface;

class ReportHealth {

    /**
     * @var Report Kesehatan Interface
     */
    protected $reportHealth;

    public function __construct(ReportHealthInterface $reportHealth)
    {
        $this->reportHealth = $reportHealth;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->reportHealth->getData($params);
    }

} 