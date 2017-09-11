<?php

namespace App\Services\Bridge\Auth\Pages;

use App\Repositories\Contracts\Auth\Pages\Santri as SantriInterface;

class Santri {

    /**
     * @var santriInterface
     */
    protected $santri;

    public function __construct(SantriInterface $santri)
    {
        $this->santri = $santri;
    }
    
    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->santri->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function changeStatus($params)
    {
        return $this->santri->changeStatus($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->santri->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->santri->edit($params);
    }

} 