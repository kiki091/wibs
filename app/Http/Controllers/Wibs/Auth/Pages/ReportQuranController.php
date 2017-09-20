<?php

namespace App\Http\Controllers\Wibs\Auth\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Wibs\BaseController;
use App\Services\Bridge\Auth\Pages\Santri as SantriServices;
use App\Services\Bridge\Auth\Pages\ReportQuran as ReportQuranServices;
use App\Services\Api\Response as ResponseService;
use App\Custom\DataHelper;

use Auth;
use Session;
use Validator;
use ValidatesRequests;

class ReportQuranController extends BaseController
{
    protected $santri;
    protected $reportQuran;
    protected $response;
    protected $validationMessage = '';

    public function __construct(SantriServices $santri, ReportQuranServices $reportQuran, ResponseService $response)
    {
        $this->santri = $santri;
        $this->reportQuran = $reportQuran;
        $this->response = $response;
    }

    /**
     * Index Of User Account
     * @return string
     */

    public function index(Request $request)
    {
        $blade = self::URL_BLADE_AUTH. '.report.quran.main';
        
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
        $data['report_quran'] = $this->reportQuran->getData();
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
            return $this->reportQuran->store($request->except(['_token']));
        }
    }

    /**
     * Edit Data Of User Account
     * @return string
     */

    public function edit(Request $request)
    {
        return $this->reportQuran->edit($request->except(['_token']));
    }

    /**
     * Validation Store 
     * @return array
     */
    private function validationStore($request = array())
    {
        $rules = [
            'disiplin'         => 'required|max:1',
            'total_hafalan'    => 'required|numeric',
            'nilai_hafalan'    => 'required|numeric',
            'nilai_tajwid'     => 'required|numeric',
            'nilai_mahraj'     => 'required|numeric',
            'description'      => 'required|max:200',
            'siswa_id'         => 'required',
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