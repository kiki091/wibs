<?php

namespace App\Repositories\Implementation\Auth\Pages;

use App\Repositories\Contracts\Auth\Pages\WaliSiswa as WaliSiswaInterface;
use App\Repositories\Implementation\BaseImplementation;
use App\Models\Msc\WaliSiswa as WaliSiswaModel;
use App\Services\Transformation\Auth\Pages\WaliSiswa as WaliSiswaTransformation;

use RouteUsersLocation;
use Carbon\Carbon;
use DataHelper;
use Cache;
use Session;
use DB;
use Hash;

class WaliSiswa extends BaseImplementation implements WaliSiswaInterface
{

    protected $waliSiswa;
    protected $waliSiswaTransformation;

    protected $message;
    protected $lastInsertId;
    protected $uniqueIdImagePrefix = '';
    

    function __construct(WaliSiswaModel $waliSiswa, WaliSiswaTransformation $waliSiswaTransformation)
    {

        $this->waliSiswa = $waliSiswa;
        $this->waliSiswaTransformation = $waliSiswaTransformation;
        $this->routeAuthSystemLocation = RouteUsersLocation::setUsersLocation();
    }

    /** 
     * get data waliSiswa
     * @param $data
     * @return array
     */

    public function getData($data)
    {
        $params = [
            'current_location_slug' => $this->currentLocation,
        ];

        $dataWaliSiswa = $this->waliSiswa($params, 'desc', 'array', false);

        return $this->waliSiswaTransformation->getDataWaliSiswaTransform($dataWaliSiswa);
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

        $dataWaliSiswa = $this->waliSiswa($params, 'asc', 'array', true);

        return $this->setResponse(trans('message.cms_success_get_data'), true, $this->waliSiswaTransformation->getSingleForEditWaliSiswaTransform($dataWaliSiswa));
    }

    /** 
     * change status data waliSiswa
     * @param $data
     * @return array
     */

    public function changeStatus($data)
    {
        try {
            if (!isset($data['id']) && empty($data['id']))
                return $this->setResponse(trans('message.cms_required_id'), false);

            DB::beginTransaction();

            $oldData = $this->waliSiswa
                ->id($data['id'])
                ->first()->toArray();

            $updatedData = [
                'is_active' => $oldData['is_active'] ? false : true,
            ];

            $changeStatus = $this->waliSiswa
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
     * store data waliSiswa
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
     * store data waliSiswa into database
     * @param $data
     * @return array
     */

    protected function storeData($data)
    {
        try {

            $store = $this->waliSiswa;

            if ($this->isEditMode($data)) {
                $store                          = $this->waliSiswa->find($data['id']);

                $store->updated_at              = $this->mysqlDateTimeFormat();

            } else {
                $store->siswa_id                = isset($data['siswa_id']) ? $data['siswa_id'] : '';
                $store->created_at              = $this->mysqlDateTimeFormat();
                $store->created_by              = DataHelper::userId();
            }

            $store->nama_lengkap_ayah           = isset($data['nama_lengkap_ayah']) ? $data['nama_lengkap_ayah'] : '';
            $store->nama_lengkap_ibu            = isset($data['nama_lengkap_ibu']) ? $data['nama_lengkap_ibu'] : '';
            $store->tempat_lahir                = isset($data['tempat_lahir']) ? $data['tempat_lahir'] : '';
            $store->tanggal_lahir               = isset($data['tanggal_lahir']) ? \Carbon\Carbon::parse($data['tanggal_lahir'])->toDateString() : '';
            $store->agama                       = isset($data['agama']) ? $data['agama'] : '';
            $store->kewarganegaraan             = isset($data['kewarganegaraan']) ? $data['kewarganegaraan'] : '';
            $store->pendidikan                     = isset($data['pendidikan']) ? $data['pendidikan'] : '';
            $store->pekerjaan                   = isset($data['pekerjaan']) ? $data['pekerjaan'] : '';
            $store->penghasilan_bulanan         = isset($data['penghasilan_bulanan']) ? $data['penghasilan_bulanan'] : '';
            $store->alamat_kantor               = isset($data['alamat_kantor']) ? $data['alamat_kantor'] : '';
            $store->telpon_kantor               = isset($data['telpon_kantor']) ? $data['telpon_kantor'] : '';
            $store->alamat_rumah                = isset($data['alamat_rumah']) ? $data['alamat_rumah'] : '';
            $store->no_telepon                  = isset($data['no_telepon']) ? $data['no_telepon'] : '';
            $store->email                       = isset($data['email']) ? $data['email'] : '';
            $store->status                      = isset($data['status']) ? $data['status'] : '';


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
     * Get All waliSiswa
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function waliSiswa($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $waliSiswa = $this->waliSiswa->with(['siswa']);

        $waliSiswa->whereHas('siswa.tingkatan', function($q) use($params){
            $q->slug($this->routeAuthSystemLocation);
        });

        if(isset($params['id'])) {
            $waliSiswa->id($params['id']);
        }

        if(isset($params['is_active'])) {
            $waliSiswa->isActive($params['is_active']);
        }

        if(isset($params['order'])) {
            $waliSiswa->orderBy($params['order'], $orderType);
        }

        if(isset($params['email'])) {
            $waliSiswa->email($params['email']);
        }

        if(!$waliSiswa->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $waliSiswa->get()->toArray();
                } else {
                    return $waliSiswa->first()->toArray();
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