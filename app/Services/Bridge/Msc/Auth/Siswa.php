<?php

namespace App\Services\Bridge\Msc\Auth;

use App\Repositories\Contracts\Msc\Auth\Siswa as SiswaInterface;

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
    public function setMscAuthSession($params = array())
    {
        return $this->siswa->setMscAuthSession($params);
    }

} 