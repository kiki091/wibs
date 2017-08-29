<?php

namespace App\Services\Bridge\Auth\Pages;

use App\Repositories\Contracts\Auth\Pages\Kitab as KitabInterface;

class Kitab {

    /**
     * @var KitabInterface
     */
    protected $kitab;

    public function __construct(KitabInterface $kitab)
    {
        $this->kitab = $kitab;
    }
    
    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->kitab->getData($params);
    }


} 