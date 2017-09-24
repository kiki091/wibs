<?php

namespace App\Services\Bridge\Auth;

use App\Repositories\Contracts\Auth\Location as LocationInterface;

class Location {

    /**
     * @var UserInterface
     */
    protected $location;

    public function __construct(LocationInterface $location)
    {
        $this->location = $location;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->location->getData($params);
    }
} 