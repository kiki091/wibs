<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['web']], function () 
{
	Route::group(['domain' => env('WORLD_WIDE_WEB') . env('MSC_DOMAIN_PREFIX'). env('APP_DOMAIN')], function()
	{
		Route::get('/', 'Wibs\Msc\Pages\MainController@index')->name('index');
		
	});
});