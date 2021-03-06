<?php

namespace App\Http\Controllers\Wibs\Msc\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Wibs\Msc\MscBaseController;
use App\Services\Bridge\Msc\Siswa as SiswaServices;
use App\Services\Bridge\Msc\ReportHealth as ReportHealthServices;
use App\Services\Bridge\Msc\ReportHadis as ReportHadisServices;
use App\Services\Bridge\Msc\ReportTahfidz as ReportTahfidzServices;
use App\Services\Api\Response as ResponseService;

class ReportHealthController extends MscBaseController
{
	protected $response;
	protected $siswa;
	protected $reportHealth;
	protected $reportHadis;
    protected $reportTahfidz;

	public function __construct(SiswaServices $siswa,ReportHealthServices $reportHealth, ReportHadisServices $reportHadis,ReportTahfidzServices $reportTahfidz, ResponseService $response) {

		$this->response = $response;
		$this->siswa = $siswa;
		$this->reportHealth = $reportHealth;
		$this->reportHadis = $reportHadis;
        $this->reportTahfidz = $reportTahfidz;
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
        
        $data['data_hadis'] = $this->reportHadis->getAll();
        $data['data_tahfidz'] = $this->reportTahfidz->getAll();
        
        return $this->response->setResponse(trans('message.success_get_data'), true, $data);
	}
}