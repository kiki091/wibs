<?php

namespace App\Http\Controllers\Wibs\Msc\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Wibs\Msc\MscBaseController;
use App\Services\Bridge\Msc\Siswa as SiswaMscServices;
use App\Services\Bridge\Msc\ReportHadis as ReportHadisServices;
use App\Services\Bridge\Msc\ReportTahfidz as ReportTahfidzServices;
use App\Services\Api\Response as ResponseService;

use Validator;
use ValidatesRequests;
use Response;
use JavaScript;
use Auth;
use Session;
use URL;

class DashboardMscController extends MscBaseController
{
	protected $siswa;
    protected $reportHadis;
    protected $reportTahfidz;
	protected $response;
    protected $validationMessage = '';

	public function __construct(SiswaMscServices $siswa, ReportHadisServices $reportHadis, ReportTahfidzServices $reportTahfidz, ResponseService $response) {

		$this->siswa = $siswa;
        $this->reportHadis = $reportHadis;
        $this->reportTahfidz = $reportTahfidz;
		$this->response = $response;

		JavaScript::put([
            'href_url' => URL::current(),
            'app_domain' => env('MSC_DOMAIN_PREFIX').env('APP_DOMAIN'),
            'token' => csrf_token(),
        ]);
        $this->middleware('siswa');
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
        
        $data['data_hadis'] = $this->reportHadis->getAll();
        $data['data_tahfidz'] = $this->reportTahfidz->getAll();
        
        return $this->response->setResponse(trans('message.success_get_data'), true, $data);
	}

    /**
     * Store Data
     * @param Request $request
     */

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validationStore($request));

        if ($validator->fails()) {
            //TODO: case fail
            return $this->response->setResponseErrorFormValidation($validator->messages(), false);

        } else {
            //TODO: case pass
            return $this->siswa->store($request->except(['_token']));
        }

    }

	/**
	 * edit data siswa
	 * @return array()
	 */

	public function edit(Request $request)
	{
		return $this->siswa->edit($request->except(['_token']));
	}

    /**
     * Change Password
     * @param Request $request
     */
    public function changePassword(Request $request)
    {

        $validator = Validator::make($request->all(), $this->validationChangePasswordForm($request));

        if ($validator->fails()) {
            //TODO: case fail
            return $this->response->setResponseErrorFormValidation($validator->messages(), false);

        } else {
            //TODO: case pass
            return $this->siswa->changePassword($request->except(['_token']));
        }
    }

    /**
     * Validation Store Landing Offers
     * @return array
     */
    private function validationStore($request = array())
    {
        $rules = [
            'email'     => 'required|email|max:45',
            'no_telpon' => 'required',
            'foto'      => 'required|dimensions:width='.FOTO_IMAGES_WIDTH.',height='.FOTO_IMAGES_HEIGHT.'|max:'. IMAGES_SIZE .'|mimes:jpeg,jpg,png',
        ];

        if (is_null($request->file('foto'))) {
            unset($rules['foto']);
        }

        return $rules;
    }

    /**
     * Validation Change Password Rules
     * @return array
     */
    private function validationChangePasswordForm()
    {
        return $rules = array(
            'old_password'      => 'required',
            'new_password'      => 'required',
            'confirm_password'  => 'required|same:new_password',
        );
    }
}