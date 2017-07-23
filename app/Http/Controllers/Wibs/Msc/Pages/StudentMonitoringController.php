<?php

namespace App\Http\Controllers\Wibs\Msc\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Wibs\Msc\MscBaseController;
use App\Services\Bridge\Msc\Siswa as SiswaMscServices;
use App\Services\Bridge\Msc\StudentMonitoring as StudentMonitoringServices;
use App\Services\Api\Response as ResponseService;

class StudentMonitoringController extends MscBaseController
{
	protected $response;
	protected $siswa;
	protected $studentMonitoring;

	public function __construct(SiswaMscServices $siswa,StudentMonitoringServices $studentMonitoring, ResponseService $response) {

		$this->response = $response;
		$this->siswa = $siswa;
		$this->studentMonitoring = $studentMonitoring;
	}

	public function index(Request $request) 
	{
		$blade = self::URL_BLADE_MSC_SITE. '.student-monitoring';

        if(view()->exists($blade)) {
        
            return view($blade);

        }

        return abort(404);
	}

	public function getData(Request $request) 
	{
		
        $data['siswa'] = $this->siswa->getData();
        $data['student_monitoring'] = $this->studentMonitoring->getData();
        
        return $this->response->setResponse(trans('message.success_get_data'), true, $data);
	}
}