<?php

namespace App\Http\Controllers\Wibs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use URL;
use Session;
use JavaScript;

class BaseController extends Controller
{

	const URL_BLADE_AUTH = 'wibs.auth.pages';

	public function __construct()
	{
		if (Auth::guard('users')->check() == null) {
           return redirect()->route('users_login');
        }
	}
}