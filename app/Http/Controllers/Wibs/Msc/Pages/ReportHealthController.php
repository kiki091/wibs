<?php

namespace App\Http\Controllers\Wibs\Msc\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Wibs\Msc\MscBaseController;
use App\Services\Bridge\Msc\Siswa as SiswaServices;
use App\Services\Bridge\Msc\ReportHealth as ReportHealthServices;
use App\Services\Api\Response as ResponseService;

class ReportHealthController extends MscBaseController
{
	protected $response;
	protected $siswa;
	protected $reportHealth;

	public function __construct(SiswaServices $siswa,ReportHealthServices $reportHealth, ResponseService $response) {

		$this->response = $response;
		$this->siswa = $siswa;
		$this->reportHealth = $reportHealth;
	}

	public function index(Request $request) 
	{
		$blade = self::URL_BLADE_MSC_SITE. '.report-health';

        if(view()->exists($blade)) {
        
            return view($blade);

        }

        return abort(404);
	}

	/**
	 * get data
	 * @return array()
	 */

	public function getData(Request $request) 
	{
		
        $data['siswa'] = $this->siswa->getData();
        $data['report_health'] = $this->reportHealth->getData();
        
        return $this->response->setResponse(trans('message.success_get_data'), true, $data);
	}
}