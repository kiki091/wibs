<?php

namespace App\Repositories\Implementation\Msc;

use App\Repositories\Contracts\Msc\StudentMonitoring as StudentMonitoringInterface;
use App\Repositories\Implementation\BaseImplementation;
use App\Models\Msc\ReportKesehatan as StudentMonitoringModel;
use App\Services\Transformation\Msc\StudentMonitoring as StudentMonitoringTransformation;
use Cache;
use LaravelLocalization;
use Session;
use DB;
use Auth;
use MscDataHelper;
use Hash;

class StudentMonitoring extends BaseImplementation implements StudentMonitoringInterface
{

    protected $studentMonitoring;
    protected $studentMonitoringTransformation;

    function __construct(StudentMonitoringModel $studentMonitoring, StudentMonitoringTransformation $studentMonitoringTransformation)
    {
        $this->studentMonitoring = $studentMonitoring;
        $this->studentMonitoringTransformation = $studentMonitoringTransformation;
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
        
        $studentMonitoringData = $this->studentMonitoring($params, 'asc', 'array', false);

        return $this->studentMonitoringTransformation->getStudentMonitoringTransform($studentMonitoringData);
    }

    /**
     * Get All User
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function studentMonitoring($params = array(), $orderType = 'desc', $returnType = 'array', $returnSingle = false)
    {
        $studentMonitoring = $this->studentMonitoring
            ->with('siswa');

        if(isset($params['id'])) {
            $studentMonitoring->id($params['id']);
        }

        if(isset($params['siswa_id'])) {
            $studentMonitoring->siswaId($params['siswa_id']);
        }

        if(isset($params['report_form'])) {
            $studentMonitoring->reportForm($params['report_form']);
        }

        if(isset($params['order_by'])) {
            $studentMonitoring->orderBy($params['order_by'], $orderType);
        }

        if(!$studentMonitoring->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $studentMonitoring->get()->toArray();
                } else {
                    return $studentMonitoring->first()->toArray();
                }
                break;
        }
    }

} 