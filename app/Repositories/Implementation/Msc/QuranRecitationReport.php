<?php

namespace App\Repositories\Implementation\Msc;

use App\Repositories\Contracts\Msc\QuranRecitationReport as QuranRecitationReportInterface;
use App\Repositories\Implementation\BaseImplementation;
use App\Models\Msc\ReportHafalanQuran as QuranRecitationReportModel;
use App\Services\Transformation\Msc\QuranRecitationReport as QuranRecitationReportTransformation;
use Cache;
use LaravelLocalization;
use Session;
use DB;
use Auth;
use MscDataHelper;
use Hash;

class QuranRecitationReport extends BaseImplementation implements QuranRecitationReportInterface
{

    protected $quranRecitationReport;
    protected $quranRecitationReportTransformation;

    function __construct(QuranRecitationReportModel $quranRecitationReport, QuranRecitationReportTransformation $quranRecitationReportTransformation)
    {
        $this->quranRecitationReport = $quranRecitationReport;
        $this->quranRecitationReportTransformation = $quranRecitationReportTransformation;
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
        
        $quranRecitationReportData = $this->quranRecitationReport($params, 'asc', 'array', false);

        return $this->quranRecitationReportTransformation->getQuranRecitationReportTransform($quranRecitationReportData);
    }

    /**
     * Get All User
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function quranRecitationReport($params = array(), $orderType = 'desc', $returnType = 'array', $returnSingle = false)
    {
        $quranRecitationReport = $this->quranRecitationReport
            ->with('siswa');

        if(isset($params['id'])) {
            $quranRecitationReport->id($params['id']);
        }

        if(isset($params['siswa_id'])) {
            $quranRecitationReport->siswaId($params['siswa_id']);
        }

        if(isset($params['report_from'])) {
            $quranRecitationReport->reportForm($params['report_from']);
        }

        if(isset($params['order_by'])) {
            $quranRecitationReport->orderBy($params['order_by'], $orderType);
        } else {
            
            $quranRecitationReport->orderBy('report_from', $orderType);
        }

        if(!$quranRecitationReport->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $quranRecitationReport->get()->toArray();
                } else {
                    return $quranRecitationReport->first()->toArray();
                }
                break;
        }
    }

} 