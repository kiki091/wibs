<?php

namespace App\Http\Controllers\Wibs\Auth\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Wibs\BaseController;
use App\Services\Bridge\Auth\Pages\Santri as SantriServices;
use App\Services\Bridge\Auth\Pages\ReportHadis as ReportHadisServices;
use App\Services\Bridge\Auth\Pages\Kitab as KitabServices;
use App\Services\Api\Response as ResponseService;
use App\Custom\DataHelper;

use Auth;
use Session;
use Validator;
use ValidatesRequests;

class ReportHadisController extends BaseController
{
    protected $santri;
    protected $kitab;
    protected $reportHadis;
    protected $response;
    protected $validationMessage = '';

    public function __construct(SantriServices $santri, KitabServices $kitab, ReportHadisServices $reportHadis, ResponseService $response)
    {
        $this->santri = $santri;
        $this->kitab = $kitab;
        $this->reportHadis = $reportHadis;
        $this->response = $response;
    }

    /**
     * Index Of User Account
     * @return string
     */

    public function index(Request $request)
    {
        $blade = self::URL_BLADE_AUTH. '.report.hadis.main';
        
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
        $data['kitab'] = $this->kitab->getData();
        $data['report_hadis'] = $this->reportHadis->getData();
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
            return $this->reportHadis->store($request->except(['_token']));
        }
    }

    /**
     * Edit Data Of User Account
     * @return string
     */

    public function edit(Request $request)
    {
        return $this->reportHadis->edit($request->except(['_token']));
    }

    /**
     * Validation Store 
     * @return array
     */
    private function validationStore($request = array())
    {
        $rules = [
            'kedisiplinan'           => 'required|max:1',
            'total_hafalan'          => 'required|max:3',
            'kekuatan_hafalan'       => 'required|max:15',
            'nilai_hafalan'          => 'required|max:3',
            'description'            => 'required|max:150',
            'kitab_id'               => 'required',
            'siswa_id'               => 'required',
        ];


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