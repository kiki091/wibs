<?php

namespace App\Repositories\Implementation\Auth\Pages;

use App\Repositories\Contracts\Auth\Pages\Kitab as KitabInterface;
use App\Repositories\Implementation\BaseImplementation;
use App\Models\Msc\Kitab as KitabModel;
use App\Services\Transformation\Auth\Pages\Kitab as KitabTransformation;

use RouteUsersLocation;
use Carbon\Carbon;
use DataHelper;
use Cache;
use Session;
use DB;
use Hash;

class Kitab extends BaseImplementation implements KitabInterface
{

    protected $kitab;
    protected $kitabTransformation;

    protected $message;
    protected $lastInsertId;
    protected $uniqueIdImagePrefix = '';


    function __construct(KitabModel $kitab, KitabTransformation $kitabTransformation)
    {

        $this->kitab = $kitab;
        $this->kitabTransformation = $kitabTransformation;
        $this->routeAuthSystemLocation = RouteUsersLocation::setUsersLocation();
    }

    /** 
     * get data kitab
     * @param $data
     * @return array
     */

    public function getData($data)
    {
        $params = [
            'current_location_slug' => $this->currentLocation,
        ];

        $dataKitab = $this->kitab($params, 'desc', 'array', false);

        return $this->kitabTransformation->getDataKitabTransform($dataKitab);
    }

    /** 
     * edit data Wali Siswa
     * @param $data
     * @return array
     */

    public function edit($data)
    {
        $params = [
            "id" => isset($data['id']) ? $data['id'] : '',
        ];

        $dataKitab = $this->kitab($params, 'asc', 'array', true);

        return $this->setResponse(trans('message.cms_success_get_data'), true, $this->kitabTransformation->getSingleForEditKitabTransform($dataKitab));
    }

    /** 
     * store data
     * @param $data
     * @return array
     */

    public function store($data)
    {
        try {

            DB::beginTransaction();
            
            if(!$this->storeData($data) == true)
            {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            DB::commit();
            return $this->setResponse(trans('message.cms_success_store_data_general'), true);

        } catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /** 
     * store data kitab into database
     * @param $data
     * @return array
     */

    protected function storeData($data)
    {
        try {

            $store = $this->kitab;

            if ($this->isEditMode($data)) {
                $store                = $this->kitab->find($data['id']);

                $store->updated_at    = $this->mysqlDateTimeFormat();

            } else {
                $store->created_at    = $this->mysqlDateTimeFormat();
                $store->created_by    = DataHelper::userId();
            }

            $store->title             = isset($data['title']) ? $data['title'] : '';
            $store->description       = isset($data['description']) ? $data['description'] : '';
            $store->nama_penulis      = isset($data['nama_penulis']) ? $data['nama_penulis'] : '';
            $store->penerbit          = isset($data['penerbit']) ? $data['penerbit'] : '';
            $store->tahun             = isset($data['tahun']) ? $data['tahun'] : '';
            $store->jilid             = isset($data['jilid']) ? $data['jilid'] : '';

            if($save = $store->save())
            {
                $this->lastInsertId = $store->id;
            }

            return $save;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /**
     * Get All kitab
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function kitab($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $kitab = $this->kitab;

        if(isset($params['id'])) {
            $kitab->id($params['id']);
        }

        if(!$kitab->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $kitab->get()->toArray();
                } else {
                    return $kitab->first()->toArray();
                }
                break;
        }
    }

    /**
     * Check need edit Mode or No
     * @param $data
     * @return bool
     */
    protected function isEditMode($data)
    {
        return isset($data['id']) && !empty($data['id']) ? true : false;
    }
}