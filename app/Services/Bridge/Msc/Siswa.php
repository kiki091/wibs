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

} 