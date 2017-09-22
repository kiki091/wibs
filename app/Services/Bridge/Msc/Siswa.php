<?php

namespace App\Services\Bridge\Msc;

use App\Repositories\Contracts\Msc\Siswa as SiswaInterface;

class Siswa {

    /**
     * @var UserInterface
     */
    protected $siswa;

    public function __construct(SiswaInterface $siswa)
    {
        $this->siswa = $siswa;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->siswa->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->siswa->edit($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function changePassword($params = array())
    {
        return $this->siswa->changePassword($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->siswa->store($params);
    }
} 