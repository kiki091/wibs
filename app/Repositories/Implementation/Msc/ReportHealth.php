<?php

namespace App\Repositories\Implementation\Msc;

use App\Repositories\Contracts\Msc\ReportHealth as ReportHealthInterface;
use App\Repositories\Implementation\BaseImplementation;
use App\Models\Msc\ReportKesehatan as ReportHealthModel;
use App\Services\Transformation\Msc\ReportHealth as ReportHealthTransformation;
use Cache;

use Session;
use DB;
use Auth;
use MscDataHelper;
use Hash;

class ReportHealth extends BaseImplementation implements ReportHealthInterface
{

    protected $reportHealth;
    protected $reportHealthTransformation;

    function __construct(ReportHealthModel $reportHealth, ReportHealthTransformation $reportHealthTransformation)
    {
        $this->reportHealth = $reportHealth;
        $this->reportHealthTransformation = $reportHealthTransformation;
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
        
        $reportHealthData = $this->reportHealth($params, 'asc', 'array', false);

        return $this->reportHealthTransformation->getReportHealthTransform($reportHealthData);
    }

    /**
     * Get All User
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function reportHealth($params = array(), $orderType = 'desc', $returnType = 'array', $returnSingle = false)
    {
        $reportHealth = $this->reportHealth
            ->with('siswa');

        if(isset($params['id'])) {
            $reportHealth->id($params['id']);
        }

        if(isset($params['siswa_id'])) {
            $reportHealth->siswaId($params['siswa_id']);
        }

        if(isset($params['report_form'])) {
            $reportHealth->reportForm($params['report_form']);
        }

        if(isset($params['order_by'])) {
            $reportHealth->orderBy($params['order_by'], $orderType);
        }

        if(!$reportHealth->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $reportHealth->get()->toArray();
                } else {
                    return $reportHealth->first()->toArray();
                }
                break;
        }
    }

} 