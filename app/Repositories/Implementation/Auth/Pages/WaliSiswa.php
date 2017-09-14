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
            'current_location_slug' => true,
        ];

        $dataWaliSiswa = $this->waliSiswa($params, 'desc', 'array', false);

        return $this->waliSiswaTransformation->getDataWaliSiswaTransform($dataWaliSiswa);
    }

    /** 
     * store data waliSiswa
     * @param $data
     * @return array
     */

    public function store($data)
    {
        try {

            DB::connection('msc')->beginTransaction();
            
            if(!$this->storeData($data) == true)
            {
                DB::connection('msc')->rollBack();
                return $this->setResponse($this->message, false);
            }

            DB::connection('msc')->commit();
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
            $store->tempat_lahir_ayah           = isset($data['tempat_lahir_ayah']) ? $data['tempat_lahir_ayah'] : '';
            $store->tempat_lahir_ibu            = isset($data['tempat_lahir_ibu']) ? $data['tempat_lahir_ibu'] : '';
            $store->tanggal_lahir_ayah          = isset($data['tanggal_lahir_ayah']) ? \Carbon\Carbon::parse($data['tanggal_lahir_ayah'])->toDateString() : '';
            $store->tanggal_lahir_ibu           = isset($data['tanggal_lahir_ibu']) ? \Carbon\Carbon::parse($data['tanggal_lahir_ibu'])->toDateString() : '';
            $store->kewarganegaraan_ayah        = isset($data['kewarganegaraan_ayah']) ? $data['kewarganegaraan_ayah'] : '';
            $store->kewarganegaraan_ibu         = isset($data['kewarganegaraan_ibu']) ? $data['kewarganegaraan_ibu'] : '';
            $store->pendidikan_ayah             = isset($data['pendidikan_ayah']) ? $data['pendidikan_ayah'] : '';
            $store->pendidikan_ibu              = isset($data['pendidikan_ibu']) ? $data['pendidikan_ibu'] : '';
            $store->pekerjaan_ayah              = isset($data['pekerjaan_ayah']) ? $data['pekerjaan_ayah'] : '';
            $store->pekerjaan_ibu               = isset($data['pekerjaan_ibu']) ? $data['pekerjaan_ibu'] : '';
            $store->penghasilan_bulanan_ayah    = isset($data['penghasilan_bulanan_ayah']) ? $data['penghasilan_bulanan_ayah'] : '';
            $store->penghasilan_bulanan_ibu     = isset($data['penghasilan_bulanan_ibu']) ? $data['penghasilan_bulanan_ibu'] : '';
            $store->email_ayah                  = isset($data['email_ayah']) ? $data['email_ayah'] : '';
            $store->email_ibu                   = isset($data['email_ibu']) ? $data['email_ibu'] : '';
            $store->status_ayah                 = isset($data['status_ayah']) ? $data['status_ayah'] : '';
            $store->status_ibu                  = isset($data['status_ibu']) ? $data['status_ibu'] : '';

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

            DB::connection('msc')->beginTransaction();

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
                DB::connection('msc')->commit();
                return $this->setResponse(trans('message.cms_success_update_status_general'), true);
            }

            DB::connection('msc')->rollBack();
            return $this->setResponse(trans('message.cms_failed_update_status_general'), false);

        } catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
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

        if(isset($params['current_location_slug'])) {
            $waliSiswa->whereHas('siswa.tingkatan', function($q) use($params){
                $q->slug($this->routeAuthSystemLocation);
            });
        }   

        if(isset($params['id'])) {
            $waliSiswa->id($params['id']);
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