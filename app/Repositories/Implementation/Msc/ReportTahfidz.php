<?php

namespace App\Repositories\Implementation\Msc;

use App\Repositories\Contracts\Msc\ReportTahfidz as ReportTahfidzInterface;
use App\Repositories\Implementation\BaseImplementation;
use App\Models\Msc\ReportHafalanQuran as ReportTahfidzModel;
use App\Services\Transformation\Msc\ReportTahfidz as ReportTahfidzTransformation;
use Cache;
use LaravelLocalization;
use Session;
use DB;
use Auth;
use MscDataHelper;
use Hash;

class ReportTahfidz extends BaseImplementation implements ReportTahfidzInterface
{

    protected $reportTahfidz;
    protected $reportTahfidzTransformation;

    function __construct(ReportTahfidzModel $reportTahfidz, ReportTahfidzTransformation $reportTahfidzTransformation)
    {
        $this->reportTahfidz = $reportTahfidz;
        $this->reportTahfidzTransformation = $reportTahfidzTransformation;
    }

    /**
     * Set MSC Auth Session
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function getData($params)
    {
        

        $siswaId = MscDataHelper::siswaId();

        if (empty($siswaId)) {
           return response()->json(['message' => 'No Privilege', 'status' => false]);
        }

        $params = [
            'siswa_id' => $siswaId,
            'order_by' => 'report_from'
        ];
        
        $reportTahfidzData = $this->reportTahfidz($params, 'asc', 'array', false);

        return $this->reportTahfidzTransformation->getReportTahfidzTransform($reportTahfidzData);
    }

    /**
     * Set MSC Auth Session
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function getAll($params)
    {
        

        $siswaId = MscDataHelper::siswaId();

        if (empty($siswaId)) {
           return response()->json(['message' => 'No Privilege', 'status' => false]);
        }

        $params = [
            'order_by' => 'nilai_hafalan',
            'limit_data'    => '3',
        ];
        
        $reportTahfidzData = $this->reportTahfidz($params, 'desc', 'array', false);

        return $this->reportTahfidzTransformation->getAllDataTransform($reportTahfidzData);
    }

    /**
     * Get All User
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function reportTahfidz($params = array(), $orderType = 'desc', $returnType = 'array', $returnSingle = false)
    {
        $reportTahfidz = $this->reportTahfidz
            ->with('siswa');

        if(isset($params['id'])) {
            $reportTahfidz->id($params['id']);
        }

        if(isset($params['siswa_id'])) {
            $reportTahfidz->siswaId($params['siswa_id']);
        }

        if(isset($params['report_from'])) {
            $reportTahfidz->reportForm($params['report_from']);
        }

        if(isset($params['order_by'])) {
            $reportTahfidz->orderBy($params['order_by'], $orderType);
        } else {
            
            $reportTahfidz->orderBy('report_from', $orderType);
        }

        if(isset($params['limit_data'])) {
            $reportTahfidz->take($params['limit_data']);
        }

        if(!$reportTahfidz->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $reportTahfidz->get()->toArray();
                } else {
                    return $reportTahfidz->first()->toArray();
                }
                break;
        }
    }

} 