<?php

namespace App\Http\Controllers\Wibs\Auth\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Wibs\BaseController;
use App\Services\Bridge\Auth\Pages\Santri as SantriServices;
use App\Services\Bridge\Auth\Pages\WaliSiswa as WaliSiswaServices;
use App\Services\Api\Response as ResponseService;
use App\Custom\DataHelper;

use Auth;
use Session;
use Validator;
use ValidatesRequests;

class WaliSiswaController extends BaseController
{
    protected $santri;
    protected $waliSiswa;
    protected $response;
    protected $validationMessage = '';

    public function __construct(SantriServices $santri, WaliSiswaServices $waliSiswa, ResponseService $response)
    {
        $this->santri = $santri;
        $this->waliSiswa = $waliSiswa;
        $this->response = $response;
    }

    /**
     * Index Of User Account
     * @return string
     */

    public function index(Request $request)
    {
        $blade = self::URL_BLADE_AUTH. '.wali-siswa.main';
        
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
        $data['wali_siswa'] = $this->waliSiswa->getData();
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
            return $this->waliSiswa->store($request->except(['_token']));
        }
    }

    /**
     * Change Status Of User Account
     * @return string
     */

    public function changeStatus(Request $request)
    {
        return $this->waliSiswa->changeStatus($request->except(['_token']));
    }

    /**
     * Edit Data Of User Account
     * @return string
     */

    public function edit(Request $request)
    {
        return $this->waliSiswa->edit($request->except(['_token']));
    }

    /**
     * Validation Store 
     * @return array
     */
    private function validationStore($request = array())
    {
        $rules = [
            'nama_lengkap_ayah'         => 'required',
            'nama_lengkap_ibu'          => 'required',
            'tempat_lahir'              => 'required',
            'tanggal_lahir'             => 'required',
            'agama'                     => 'required',
            'kewarganegaraan'           => 'required',
            'pendidikan'                => 'required',
            'pekerjaan'                 => 'required',
            'penghasilan_bulanan'       => 'required',
            'alamat_kantor'             => 'required',
            'telpon_kantor'             => 'required',
            'alamat_rumah'              => 'required',
            'no_telepon'                => 'required',
            'email'                     => 'required|email|max:30',
            'status'                    => 'required',
            'siswa_id'                  => 'required',
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