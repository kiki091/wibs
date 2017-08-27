<?php

namespace App\Services\Bridge\Auth\Pages;

use App\Repositories\Contracts\Auth\Pages\ReportQuran as ReportQuranInterface;

class ReportQuran {

    /**
     * @var santriInterface
     */
    protected $reportQuran;

    public function __construct(ReportQuranInterface $reportQuran)
    {
        $this->reportQuran = $reportQuran;
    }
    
    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->reportQuran->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->reportQuran->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->reportQuran->edit($params);
    }

} 