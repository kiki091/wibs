<?php

namespace App\Http\Controllers\Wibs\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Wibs\BaseController;

use Carbon\Carbon;
use JavaScript;
use Auth;
use Session;
use Validator;
use Symfony\Component\VarDumper\Cloner\Data;
use URL;

class DashboardController extends BaseController
{
    public function __construct()
    {

        $this->middleware('users');
        
        JavaScript::put([
            'href_url' => URL::current(),
            'app_domain' => env('AUTH_DOMAIN_PREFIX'),
            'token' => csrf_token(),
        ]);
    }

    /**
     * Index Of Dashboard
     * @return string
     */
    public function index(Request $request)
    {

        $blade = self::URL_BLADE_AUTH. '.dashboard';
        
        if(view()->exists($blade)) {
        
            return view($blade);

        }

        return abort(404);

    }
}