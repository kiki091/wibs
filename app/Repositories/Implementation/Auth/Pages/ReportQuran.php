<?php

namespace App\Repositories\Implementation\Auth\Pages;

use App\Repositories\Contracts\Auth\Pages\ReportQuran as ReportQuranInterface;
use App\Repositories\Implementation\BaseImplementation;
use App\Models\Msc\ReportHafalanQuran as ReportHafalanQuranModel;
use App\Services\Transformation\Auth\Pages\ReportQuran as ReportQuranTransformation;

use RouteUsersLocation;
use Carbon\Carbon;
use DataHelper;
use Cache;
use Session;
use DB;
use Hash;

class ReportQuran extends BaseImplementation implements ReportQuranInterface
{

    protected $reportQuran;
    protected $reportQuranTransformation;

    protected $message;
    protected $lastInsertId;
    protected $uniqueIdImagePrefix = '';


    function __construct(ReportHafalanQuranModel $reportQuran, ReportQuranTransformation $reportQuranTransformation)
    {

        $this->reportQuran = $reportQuran;
        $this->reportQuranTransformation = $reportQuranTransformation;
        $this->routeAuthSystemLocation = RouteUsersLocation::setUsersLocation();
    }

    /** 
     * get data reportQuran
     * @param $data
     * @return array
     */

    public function getData($data)
    {
        $params = [
            'current_location_slug' => $this->currentLocation,
        ];

        $dataReportQuran = $this->reportQuran($params, 'desc', 'array', false);

        return $this->reportQuranTransformation->getDataReportQuranTransform($dataReportQuran);
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

        $dataReportQuran = $this->reportQuran($params, 'asc', 'array', true);

        return $this->setResponse(trans('message.cms_success_get_data'), true, $this->reportQuranTransformation->getSingleForEditReportQuranTransform($dataReportQuran));
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
     * store data reportQuran into database
     * @param $data
     * @return array
     */

    protected function storeData($data)
    {
        try {

            $store = $this->reportQuran;

            if ($this->isEditMode($data)) {
                $store                 = $this->reportQuran->find($data['id']);

                $store->updated_at     = $this->mysqlDateTimeFormat();

            } else {
                $store->siswa_id       = isset($data['siswa_id']) ? $data['siswa_id'] : '';
                $store->created_at     = $this->mysqlDateTimeFormat();
                $store->created_by     = DataHelper::userId();
            }

            $store->disiplin           = isset($data['disiplin']) ? $data['disiplin'] : '';
            $store->total_hafalan      = isset($data['total_hafalan']) ? $data['total_hafalan'] : '';
            $store->nilai_hafalan      = isset($data['nilai_hafalan']) ? $data['nilai_hafalan'] : '';
            $store->nilai_tajwid       = isset($data['nilai_tajwid']) ? $data['nilai_tajwid'] : '';
            $store->nilai_mahraj       = isset($data['nilai_mahraj']) ? $data['nilai_mahraj'] : '';
            $store->description        = isset($data['description']) ? $data['description'] : '';
            $store->report_from        = date('Y-m-d');

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
     * Get All reportQuran
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function reportQuran($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $reportQuran = $this->reportQuran->with(['siswa']);

        // $reportQuran->whereHas('siswa.tingkatan', function($q) use($params){
        //     $q->slug($this->routeAuthSystemLocation);
        // });

        if(isset($params['id'])) {
            $reportQuran->id($params['id']);
        }

        if(isset($params['order'])) {
            $reportQuran->orderBy($params['order'], $orderType);
        }

        if(!$reportQuran->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $reportQuran->get()->toArray();
                } else {
                    return $reportQuran->first()->toArray();
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