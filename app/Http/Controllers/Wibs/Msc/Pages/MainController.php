<?php

namespace App\Http\Controllers\Wibs\Msc\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Wibs\Msc\MscBaseController;
use App\Services\Api\Response as ResponseService;

class MainController extends MscBaseController
{
	public function __construct() {

	}

	public function index(Request $request) 
	{
		dd("data return");

		$blade = self::URL_BLADE_MSC_SITE. '.main';
        
        if(view()->exists($blade)) {
        
            return view($blade);

        }

        return abort(404);
	}
}