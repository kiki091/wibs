<?php

namespace App\Http\Controllers\Wibs\Msc\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Http\Controllers\Wibs\Msc\MscBaseController;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Services\Bridge\Msc\Auth\Siswa as SiswaMscServices;
use App\Custom\Msc\MscDataHelper;
use App\Services\Api\Response as ResponseService;
use Session;
use Auth;
use Validator;
use ValidatesRequests;
use Response;

class AuthMscController extends MscBaseController
{
	use AuthenticatesAndRegistersUsers;

    protected $validationMessage = '';
    protected $validationChangePasswordForm = '';
    protected $response;
    protected $userMsc;

    protected $guard = 'siswa';

    public function __construct(SiswaMscServices $userMsc, ResponseService $response)
    {
        if (Auth::guard('siswa')->check() == null) {
           return redirect()->route('msc_login');
        }

        $this->userMsc = $userMsc;
        $this->response = $response;
    }

    public function index(Request $request)
    {
        $blade = self::URL_BLADE_MSC_SITE. '.auth.login';
        
        if(view()->exists($blade)) {
        
            return view($blade);

        }

        return abort(404);
    }
/**
     * @param Request $request
     */
    public function authenticate(Request $request)
    {
        //TODO: Validation Auth
        if (!$this->validationAuth($request->input())) {
            return redirect(route('msc_login'))
                ->withInput($request->only($this->loginUsername(), 'remember'))
                ->withErrors($this->validationMessage);
        }

        $credentials = $request->only('nis', 'password');
        $credentials['is_active'] = true;

        if (Auth::guard('siswa')->attempt($credentials)) {
            //TODO: set session first
            if ($this->userMsc->setMscAuthSession()) {
                //TODO : redirect to dashboard
               return $this->manageRedirectAfterLogin();
            }
        }

        return redirect(route('msc_login'))
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function loginUsername()
    {
        return property_exists($this, 'username') ? $this->username : 'nis';
    }

    /**
     * Get the failed login message.
     *
     * @return string
     */
    protected function getFailedLoginMessage()
    {
        return Lang::has('auth.failed')
                ? Lang::get('auth.failed')
                : 'These credentials do not match our records.';
    }

    /**
     * Manage redirect after login
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    private function manageRedirectAfterLogin()
    {
        $siswaInfo = MscDataHelper::siswaInfo();

        if (isset($siswaInfo['nama_lengkap']) && !empty($siswaInfo['nama_lengkap'])) {
            
            return redirect('/'.str_slug($siswaInfo['nama_lengkap']));
        }

        return redirect('/');
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
            //return $this->userMsc->changePassword($request->except(['_token']));
        }
    }

    /**
     * Validation for authenticate
     * @param $credentials
     * @return bool
     */
    private function validationAuth($credentials)
    {
        $validator = Validator::make($credentials, $this->getValidationRules());

        if ($validator->fails()) {
            $this->validationMessage = $validator->messages();
            return false;
        }
        return true;
    }

    /**
     * Validation Rules
     * @return array
     */
    private function getValidationRules()
    {
        return $rules = array(
            'nis'         => 'required',
            'password'      => 'required',
        );
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
    
    /**
     * Logout
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Auth::guard('siswa')->logout();
        Session::flush();

        return redirect(route('msc_login'));
    }

}