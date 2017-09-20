<?php

namespace App\Repositories\Implementation\Auth\Pages;

use App\Repositories\Contracts\Auth\Pages\ReportHadis as ReportHadisInterface;
use App\Repositories\Implementation\BaseImplementation;
use App\Models\Msc\ReportHadis as ReportHadisModel;
use App\Services\Transformation\Auth\Pages\ReportHadis as ReportHadisTransformation;

use RouteUsersLocation;
use Carbon\Carbon;
use DataHelper;
use Cache;
use Session;
use DB;
use Hash;

class ReportHadis extends BaseImplementation implements ReportHadisInterface
{

    protected $reportHadis;
    protected $reportHadisTransformation;

    protected $message;
    protected $lastInsertId;
    protected $uniqueIdImagePrefix = '';


    function __construct(ReportHadisModel $reportHadis, ReportHadisTransformation $reportHadisTransformation)
    {

        $this->reportHadis = $reportHadis;
        $this->reportHadisTransformation = $reportHadisTransformation;
        $this->routeAuthSystemLocation = RouteUsersLocation::setUsersLocation();
    }

    /** 
     * get data reportHadis
     * @param $data
     * @return array
     */

    public function getData($data)
    {
        $params = [
            'current_location_slug' => $this->currentLocation,
        ];

        $dataReportHadis = $this->reportHadis($params, 'desc', 'array', false);

        return $this->reportHadisTransformation->getDataReportHadisTransform($dataReportHadis);
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

        $ReportHadis = $this->reportHadis($params, 'asc', 'array', true);

        return $this->setResponse(trans('message.cms_success_get_data'), true, $this->reportHadisTransformation->getSingleForEditReportHadisTransform($ReportHadis));
    }

    /** 
     * store data
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
     * store data reportHadis into database
     * @param $data
     * @return array
     */

    protected function storeData($data)
    {
        try {

            $store = $this->reportHadis;

            if ($this->isEditMode($data)) {
                $store                      = $this->reportHadis->find($data['id']);

                $store->updated_at          = $this->mysqlDateTimeFormat();

            } else {
                $store->siswa_id            = isset($data['siswa_id']) ? $data['siswa_id'] : '';
                $store->created_at          = $this->mysqlDateTimeFormat();
                $store->created_by          = DataHelper::userId();
            }

            $store->kitab_id                = isset($data['kitab_id']) ? $data['kitab_id'] : '';
            $store->kedisiplinan            = isset($data['kedisiplinan']) ? $data['kedisiplinan'] : '';
            $store->total_hafalan           = isset($data['total_hafalan']) ? $data['total_hafalan'] : '';
            $store->kekuatan_hafalan        = isset($data['kekuatan_hafalan']) ? $data['kekuatan_hafalan'] : '';
            $store->nilai_hafalan           = isset($data['nilai_hafalan']) ? $data['nilai_hafalan'] : '';
            $store->description             = isset($data['description']) ? $data['description'] : '';
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
     * Get All reportHadis
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function reportHadis($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $reportHadis = $this->reportHadis->with(['siswa']);

        // $reportHadis->whereHas('siswa.tingkatan', function($q) use($params){
        //     $q->slug($this->routeAuthSystemLocation);
        // });

        if(isset($params['id'])) {
            $reportHadis->id($params['id']);
        }

        if(isset($params['order'])) {
            $reportHadis->orderBy($params['order'], $orderType);
        }

        if(!$reportHadis->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $reportHadis->get()->toArray();
                } else {
                    return $reportHadis->first()->toArray();
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