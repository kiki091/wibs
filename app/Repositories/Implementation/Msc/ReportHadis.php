<?php

namespace App\Repositories\Implementation\Msc;

use App\Repositories\Contracts\Msc\ReportHadis as ReportHadisInterface;
use App\Repositories\Implementation\BaseImplementation;
use App\Models\Msc\ReportHadis as ReportHadisModel;
use App\Services\Transformation\Msc\ReportHadis as ReportHadisTransformation;
use Cache;
use LaravelLocalization;
use Session;
use DB;
use Auth;
use MscDataHelper;
use Hash;

class ReportHadis extends BaseImplementation implements ReportHadisInterface
{

    protected $reportHadis;
    protected $reportHadisTransformation;

    function __construct(ReportHadisModel $reportHadis, ReportHadisTransformation $reportHadisTransformation)
    {
        $this->reportHadis = $reportHadis;
        $this->reportHadisTransformation = $reportHadisTransformation;
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
        
        $reportHadisData = $this->reportHadis($params, 'asc', 'array', false);

        return $this->reportHadisTransformation->getReportHadisTransform($reportHadisData);
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
        
        $reportHadisData = $this->reportHadis($params, 'desc', 'array', false);

        return $this->reportHadisTransformation->getAllDataTransform($reportHadisData);
    }

    /**
     * Get All User
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function reportHadis($params = array(), $orderType = 'desc', $returnType = 'array', $returnSingle = false)
    {
        $reportHadis = $this->reportHadis
            ->with('siswa')->with('kitab');

        if(isset($params['id'])) {
            $reportHadis->id($params['id']);
        }

        if(isset($params['siswa_id'])) {
            $reportHadis->siswaId($params['siswa_id']);
        }

        if(isset($params['report_from'])) {
            $reportHadis->reportForm($params['report_from']);
        }

        if(isset($params['order_by'])) {
            $reportHadis->orderBy($params['order_by'], $orderType);
        } else {
            
            $reportHadis->orderBy('report_from', $orderType);
        }

        if(isset($params['limit_data'])) {
            $reportHadis->take($params['limit_data']);
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

} 