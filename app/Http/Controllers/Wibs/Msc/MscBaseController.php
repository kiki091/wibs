<?php

namespace App\Http\Controllers\Wibs\Msc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use URL;
use Session;
use JavaScript;

class MscBaseController extends Controller
{

	const URL_BLADE_MSC_SITE = 'wibs.msc.pages';

	public function __construct()
	{

        if (Auth::guard('siswa')->check() == null) {
           return redirect()->route('msc_login');
        }
	}
}