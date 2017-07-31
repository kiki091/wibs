<?php

namespace App\Http\Controllers\Wibs\Msc\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Wibs\Msc\MscBaseController;
use App\Services\Bridge\Msc\Siswa as SiswaMscServices;
use App\Services\Bridge\Msc\QuranRecitationReport as QuranRecitationReportServices;
use App\Services\Api\Response as ResponseService;

class QuranRecitationReportController extends MscBaseController
{
	protected $response;
	protected $siswa;
	protected $quranRecitationReport;

	public function __construct(SiswaMscServices $siswa,QuranRecitationReportServices $quranRecitationReport, ResponseService $response) {

		$this->response = $response;
		$this->siswa = $siswa;
		$this->quranRecitationReport = $quranRecitationReport;
	}

	public function index(Request $request) 
	{
		$blade = self::URL_BLADE_MSC_SITE. '.quran-recitation';

        if(view()->exists($blade)) {
        
            return view($blade);

        }

        return abort(404);
	}

	public function getData(Request $request) 
	{
		
        $data['siswa'] = $this->siswa->getData();
        $data['quran_recitation'] = $this->quranRecitationReport->getData();
        
        return $this->response->setResponse(trans('message.success_get_data'), true, $data);
	}
}