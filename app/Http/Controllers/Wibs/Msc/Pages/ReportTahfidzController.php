<?php

namespace App\Http\Controllers\Wibs\Msc\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Wibs\Msc\MscBaseController;
use App\Services\Bridge\Msc\Siswa as SiswaMscServices;
use App\Services\Bridge\Msc\ReportTahfidz as ReportTahfidzServices;
use App\Services\Api\Response as ResponseService;

class ReportTahfidzController extends MscBaseController
{
	protected $response;
	protected $siswa;
	protected $reportTahfidz;

	public function __construct(SiswaMscServices $siswa,ReportTahfidzServices $reportTahfidz, ResponseService $response) {

		$this->response = $response;
		$this->siswa = $siswa;
		$this->reportTahfidz = $reportTahfidz;
	}

	public function index(Request $request) 
	{
		$blade = self::URL_BLADE_MSC_SITE. '.report-tahfidz';

        if(view()->exists($blade)) {
        
            return view($blade);

        }

        return abort(404);
	}

	public function getData(Request $request) 
	{
		
        $data['siswa'] = $this->siswa->getData();
        $data['report_tahfidz'] = $this->reportTahfidz->getData();
        
        return $this->response->setResponse(trans('message.success_get_data'), true, $data);
	}
}