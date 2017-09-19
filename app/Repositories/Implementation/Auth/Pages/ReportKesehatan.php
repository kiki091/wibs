<?php

namespace App\Repositories\Implementation\Auth\Pages;

use App\Repositories\Contracts\Auth\Pages\ReportKesehatan as ReportKesehatanInterface;
use App\Repositories\Implementation\BaseImplementation;
use App\Models\Msc\ReportKesehatan as ReportKesehatanModel;
use App\Services\Transformation\Auth\Pages\ReportKesehatan as ReportKesehatanTransformation;

use RouteUsersLocation;
use Carbon\Carbon;
use DataHelper;
use Cache;
use Session;
use DB;
use Hash;

class ReportKesehatan extends BaseImplementation implements ReportKesehatanInterface
{

    protected $reportKesehatan;
    protected $reportKesehatanTransformation;

    protected $message;
    protected $lastInsertId;
    protected $uniqueIdImagePrefix = '';


    function __construct(ReportKesehatanModel $reportKesehatan, ReportKesehatanTransformation $reportKesehatanTransformation)
    {

        $this->reportKesehatan = $reportKesehatan;
        $this->reportKesehatanTransformation = $reportKesehatanTransformation;
        $this->routeAuthSystemLocation = RouteUsersLocation::setUsersLocation();
    }

    /** 
     * get data reportKesehatan
     * @param $data
     * @return array
     */

    public function getData($data)
    {
        $params = [
            'current_location_slug' => $this->currentLocation,
        ];

        $dataReportKesehatan = $this->reportKesehatan($params, 'desc', 'array', false);

        return $this->reportKesehatanTransformation->getDataReportKesehatanTransform($dataReportKesehatan);
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

        $dataReportKesehatan = $this->reportKesehatan($params, 'asc', 'array', true);

        return $this->setResponse(trans('message.cms_success_get_data'), true, $this->reportKesehatanTransformation->getSingleForEditReportKesehatanTransform($dataReportKesehatan));
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
     * store data reportKesehatan into database
     * @param $data
     * @return array
     */

    protected function storeData($data)
    {
        try {

            $store = $this->reportKesehatan;

            if ($this->isEditMode($data)) {
                $store                      = $this->reportKesehatan->find($data['id']);

                $store->updated_at          = $this->mysqlDateTimeFormat();

            } else {
                $store->siswa_id            = isset($data['siswa_id']) ? $data['siswa_id'] : '';
                $store->created_at          = $this->mysqlDateTimeFormat();
                $store->created_by          = DataHelper::userId();
            }

            $store->berat_badan             = isset($data['berat_badan']) ? $data['berat_badan'] : '';
            $store->tinggi_badan            = isset($data['tinggi_badan']) ? $data['tinggi_badan'] : '';
            $store->tensi_darah             = isset($data['tensi_darah']) ? $data['tensi_darah'] : '';
            $store->golongan_darah          = isset($data['golongan_darah']) ? $data['golongan_darah'] : '';
            $store->riwayat_sakit           = isset($data['riwayat_sakit']) ? $data['riwayat_sakit'] : '';
            $store->keadaan_siswa           = isset($data['keadaan_siswa']) ? $data['keadaan_siswa'] : '';
            $store->keadaan_siswa_other     = isset($data['keadaan_siswa_other']) ? $data['keadaan_siswa_other'] : '';
            $store->report_from             = date('Y-m-d');

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
     * Get All reportKesehatan
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function reportKesehatan($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $reportKesehatan = $this->reportKesehatan->with(['siswa']);

        // $reportKesehatan->whereHas('siswa.tingkatan', function($q) use($params){
        //     $q->slug($this->routeAuthSystemLocation);
        // });

        if(isset($params['id'])) {
            $reportKesehatan->id($params['id']);
        }

        if(isset($params['order'])) {
            $reportKesehatan->orderBy($params['order'], $orderType);
        }

        if(!$reportKesehatan->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $reportKesehatan->get()->toArray();
                } else {
                    return $reportKesehatan->first()->toArray();
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