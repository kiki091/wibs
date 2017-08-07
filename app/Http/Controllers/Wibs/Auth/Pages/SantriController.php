<?php

namespace App\Http\Controllers\Wibs\Auth\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Services\Bridge\Auth\Pages\Santri as SantriServices;
use App\Services\Api\Response as ResponseService;
use App\Custom\DataHelper;

use Auth;
use Session;
use Validator;
use ValidatesRequests;

class SantriController extends BaseController
{
    protected $santri;
    protected $response;
    protected $validationMessage = '';

    public function __construct(SantriServices $santri, ResponseService $response)
    {
        $this->santri = $santri;
        $this->response = $response;
    }

    /**
     * Index Of User Account
     * @return string
     */

    public function index(Request $request)
    {
        $blade = self::URL_BLADE_AUTH. '.santri.main';
        
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
        return $this->response->setResponse(trans('message.cms_success_get_data'), true, $data);
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
            return $this->santri->store($request->except(['_token']));
        }
    }

    /**
     * Change Status Of User Account
     * @return string
     */

    public function changeStatus(Request $request)
    {
        return $this->santri->changeStatus($request->except(['_token']));
    }

    /**
     * Edit Data Of User Account
     * @return string
     */

    public function edit(Request $request)
    {
        return $this->santri->edit($request->except(['_token']));
    }

    /**
     * Validation Store 
     * @return array
     */
    private function validationStore($request = array())
    {
        $rules = [
            'name'               => 'required',
            'email'              => 'required|email|max:30',
            'password'           => 'required|min:6|max:20',
            'confirm_password'   => 'required|same:password|min:6|max:20',
            'menu_id'            => 'required',
            'location_id'        => 'required',
            'system_id'          => 'required',
            'privilage_id'       => 'required',
        ];

        if ($this->isEditMode($request->input())) 
        {
            if (is_null($request->file('foto'))) {
                unset($rules['foto']);
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