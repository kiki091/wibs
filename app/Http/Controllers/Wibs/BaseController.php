<?php

namespace App\Http\Controllers\Wibs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use URL;
use Session;
use JavaScript;

class BaseController extends Controller
{

	const URL_BLADE_SITE = 'wibs.msc.pages';

	public function __construct()
	{

		$this->_init();
        $this->setJavascriptVariable();
	}
}