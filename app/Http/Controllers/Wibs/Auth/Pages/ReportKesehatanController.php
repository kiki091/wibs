<?php

namespace App\Http\Controllers\Wibs\Auth\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Wibs\BaseController;
use App\Services\Bridge\Auth\Pages\Santri as SantriServices;
use App\Services\Bridge\Auth\Pages\ReportKesehatan as ReportKesehatanServices;
use App\Services\Api\Response as ResponseService;
use App\Custom\DataHelper;

use Auth;
use Session;
use Validator;
use ValidatesRequests;

class ReportKesehatanController extends BaseController
{
    protected $santri;
    protected $reportKesehatan;
    protected $response;
    protected $validationMessage = '';

    public function __construct(SantriServices $santri, ReportKesehatanServices $reportKesehatan, ResponseService $response)
    {
        $this->santri = $santri;
        $this->reportKesehatan = $reportKesehatan;
        $this->response = $response;
    }

    /**
     * Index Of User Account
     * @return string
     */

    public function index(Request $request)
    {
        $blade = self::URL_BLADE_AUTH. '.report.kesehatan.main';
        
        if(view()->exists($blade)) {
        
            return view($blade);

        }

        return abort(404);
    }

    /**
     * Get Data Of User Account
     * @return string
     */

    public function getData(Request $request)
    {
        $data['santri'] = $this->santri->getData();
        $data['report_kesehatan'] = $this->reportKesehatan->getData();
        return $this->response->setResponse(trans('message.cms_success_get_data'), true, $data);
    }

    /**
     * Search Data
     * @param
     * @return array
     */

    public function searchData(Request $request)
    {
        $params['nis'] = $request->get('nis');

        $data['nis'] = $this->santri->getData($params);

        return $this->response->setResponse(trans('success_get_data'), true, $data);
    }

    /**
     * Change Status Of User Account
     * @param array
     * @return string
     */

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validationStore($request));

        if ($validator->fails()) {
            //TODO: case fail
            return $this->response->setResponseErrorFormValidation($validator->messages(), false);

        } else {
            //TODO: case pass
            return $this->reportKesehatan->store($request->except(['_token']));
        }
    }

    /**
     * Edit Data Of User Account
     * @return string
     */

    public function edit(Request $request)
    {
        return $this->reportKesehatan->edit($request->except(['_token']));
    }

    /**
     * Validation Store 
     * @return array
     */
    private function validationStore($request = array())
    {
        $rules = [
            'berat_badan'           => 'required|max:3',
            'tinggi_badan'          => 'required|max:3',
            'tensi_darah'           => 'required|max:10',
            'golongan_darah'        => 'required|max:2',
            'riwayat_sakit'         => 'required|max:150',
            'keadaan_siswa'         => 'required|max:100',
            'siswa_id'              => 'required',
        ];

        if ($this->isEditMode($request->input())) 
        {
            if (is_null($request->input('siswa_id'))) {
                unset($rules['siswa_id']);
            }
        }

        return $rules;
    }

    /**
     * Check is edit mode or no
     * @param $data
     * @return bool
     */
    protected function isEditMode($data)
    {
        return isset($data['id']) && !empty($data['id']) ? true : false;
    }
}