<?php

namespace App\Http\Controllers\Wibs\Msc\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Wibs\Msc\MscBaseController;
use App\Services\Bridge\Msc\Siswa as SiswaMscServices;
use App\Services\Api\Response as ResponseService;

use JavaScript;
use Auth;
use Session;
use URL;

class DashboardMscController extends MscBaseController
{
	protected $siswa;
	protected $response;

	public function __construct(SiswaMscServices $siswa, ResponseService $response) {

		$this->siswa = $siswa;
		$this->response = $response;

		JavaScript::put([
            'href_url' => URL::current(),
            'app_domain' => env('MSC_DOMAIN_PREFIX').env('APP_DOMAIN'),
            'token' => csrf_token(),
        ]);
	}

	public function index(Request $request) 
	{
		$blade = self::URL_BLADE_MSC_SITE. '.dashboard';

        if(view()->exists($blade)) {
        
            return view($blade);

        }

        return abort(404);
	}

	public function getData(Request $request) 
	{
		
        $data['siswa'] = $this->siswa->getData();
        
        return $this->response->setResponse(trans('message.success_get_data'), true, $data);
	}
}