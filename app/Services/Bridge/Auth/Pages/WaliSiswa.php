<?php

namespace App\Services\Bridge\Auth\Pages;

use App\Repositories\Contracts\Auth\Pages\WaliSiswa as WaliSiswaInterface;

class WaliSiswa {

    /**
     * @var santriInterface
     */
    protected $waliSiswa;

    public function __construct(WaliSiswaInterface $waliSiswa)
    {
        $this->waliSiswa = $waliSiswa;
    }
    
    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->waliSiswa->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function changeStatus($params)
    {
        return $this->waliSiswa->changeStatus($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->waliSiswa->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->waliSiswa->edit($params);
    }

} 