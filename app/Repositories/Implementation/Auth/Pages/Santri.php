<?php

namespace App\Repositories\Implementation\Auth\Pages;

use App\Repositories\Contracts\Auth\Pages\Santri as SantriInterface;
use App\Repositories\Implementation\BaseImplementation;
use App\Models\Msc\Siswa as SantriModel;
use App\Services\Transformation\Auth\Pages\Santri as SantriTransformation;

use DataHelper;
use Cache;
use Session;
use DB;

class Santri extends BaseImplementation implements SantriInterface
{

    protected $santri;
    protected $santriTransformation;

    protected $message;
    protected $lastInsertId;
    protected $uniqueIdImagePrefix = '';
    
    const PREFIX_IMAGE_NAME = 'wibs__profile__images';

    function __construct(SantriModel $santri, SantriTransformation $santriTransformation)
    {

        $this->santri = $santri;
        $this->santriTransformation = $santriTransformation;
        $this->uniqueIdImagePrefix = uniqid(self::PREFIX_IMAGE_NAME);
    }

    /** 
     * get data santri
     * @param $data
     * @return array
     */

    public function getData($data)
    {
        $params = [
            'current_location_slug' => $this->currentLocation,
        ];

        $dataSantri = $this->santri($params, 'desc', 'array', false);

        return $this->santriTransformation->getDataSantriTransform($dataSantri);
    }

    /** 
     * edit data santri
     * @param $data
     * @return array
     */

    public function edit($data)
    {
        $params = [
            "id" => isset($data['id']) ? $data['id'] : '',
        ];

        $dataSantri = $this->santri($params, 'asc', 'array', true);

        return $this->setResponse(trans('message.cms_success_get_data'), true, $this->santriTransformation->getSingleForEditSantriTransform($dataSantri));
    }

    /** 
     * change status data santri
     * @param $data
     * @return array
     */

    public function changeStatus($data)
    {
        try {
            if (!isset($data['id']) && empty($data['id']))
                return $this->setResponse(trans('message.cms_required_id'), false);

            DB::beginTransaction();

            $oldData = $this->santri
                ->id($data['id'])
                ->first()->toArray();

            $updatedData = [
                'is_active' => $oldData['is_active'] ? false : true,
            ];

            $changeStatus = $this->santri
                ->id($data['id'])
                ->update($updatedData);

            if($changeStatus) {
                DB::commit();
                return $this->setResponse(trans('message.cms_success_update_status_general'), true);
            }

            DB::rollBack();
            return $this->setResponse(trans('message.cms_failed_update_status_general'), false);

        } catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /** 
     * store data santri
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
     * store data santri into database
     * @param $data
     * @return array
     */

    protected function storeData($data)
    {
        try {

            $store = $this->santri;

            if ($this->isEditMode($data)) {
                $store          = $this->santri->find($data['id']);

                if (!empty($data['foto'])) {
                    $store->foto       = $this->uniqueIdImagePrefix . '_' .$data['foto']->getClientOriginalName();
                }

                $store->updated_at = $this->mysqlDateTimeFormat();

            } else {
                $store->foto        = isset($data['foto']) ? $this->uniqueIdImagePrefix . '_' .$data['foto']->getClientOriginalName() : '';
                $store->is_active   = true;
                $store->created_at  = $this->mysqlDateTimeFormat();
                $store->created_by  = DataHelper::userId();
            }

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
     * Get All santri
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function santri($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $santri = $this->santri->with(['tingkatan','kelas','wali_siswa']);

        if(isset($params['current_location_slug']) && $params['current_location_slug']) {
            $santri->whereHas('tingkatan', function($q) use($params){
                $q->slug($params['current_location_slug']);
            });
        }

        if(isset($params['id'])) {
            $santri->santriId($params['id']);
        }

        if(isset($params['is_active'])) {
            $santri->isActive($params['is_active']);
        }

        if(isset($params['order'])) {
            $santri->orderBy($params['order'], $orderType);
        }

        if(isset($params['email'])) {
            $santri->email($params['email']);
        }

        if(isset($params['nis'])) {
            $santri->nis($params['nis']);
        }

        if(!$santri->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $santri->get()->toArray();
                } else {
                    return $santri->first()->toArray();
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