<?php

namespace App\Repositories\Implementation\Auth;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Auth\Location as LocationInterface;
use App\Models\Auth\Location as LocationModel;
use App\Services\Transformation\Auth\Location as LocationTransformation;
use App\Custom\Facades\DataHelper;

use Cache;
use Session;
use DB;
use Auth;
use Hash;

class Location extends BaseImplementation implements LocationInterface
{

    protected $location;
    protected $locationTransformation;

    function __construct(LocationModel $location, LocationTransformation $locationTransformation)
    {

        $this->location = $location;
        $this->locationTransformation = $locationTransformation;
    }

    /**
     * Get Data location
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function getData($data)
    {
    	$params = [
    		'order'	=> 'name',
    	];

    	$locationData = $this->location($params, 'asc', 'array', false);

    	return $this->locationTransformation->getLocationCmsTransform($locationData);
    }

    /**
     * Get All Data location
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    
    protected function location($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
    	$location = $this->location;

        if(isset($params['id'])) {
            $location->id($params['id']);
        }

        if(isset($params['order'])) {
            $location->orderBy($params['order'], $orderType);
        }

        if(!$location->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $location->get()->toArray();
                } else {
                    return $location->first()->toArray();
                }
            break;
        }
    }

}