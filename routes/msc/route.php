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
	//Route::group(['domain' => env('WORLD_WIDE_WEB') . env('MSC_DOMAIN_PREFIX'). env('APP_DOMAIN')], function()
	Route::group(['domain' => env('WORLD_WIDE_WEB') . env('MSC_DOMAIN_PREFIX')], function()
	{
		Route::get('/', 'Wibs\Msc\Auth\AuthMscController@index')->name('msc_login');
		Route::get('/login', 'Wibs\Msc\Auth\AuthMscController@index')->name('login');
		Route::post('authenticate', 'Wibs\Msc\Auth\AuthMscController@authenticate')->name('msc_authenticate');
		Route::get('logout', 'Wibs\Msc\Auth\AuthMscController@logout')->name('msc_logout');

		Route::group(['prefix' => RouteMscLocation::setUsernameMscToSlug(), 'middleware' => ['auth', 'msc.privilege']], function (){

			Route::get('/', 'Wibs\Msc\Pages\DashboardMscController@index')->name('msc_dashboard');
			Route::get('data', 'Wibs\Msc\Pages\DashboardMscController@getData')->name('msc_get_data_siswa');
			Route::post('edit', 'Wibs\Msc\Pages\DashboardMscController@edit')->name('msc_edit_data_siswa');
			Route::post('store', 'Wibs\Msc\Pages\DashboardMscController@store')->name('msc_store_data_siswa');
			Route::post('change-password', 'Wibs\Msc\Pages\DashboardMscController@changePassword')->name('msc_change_password_data_siswa');

			Route::group(['prefix' => 'report-health'], function (){
				Route::get('/', 'Wibs\Msc\Pages\ReportHealthController@index')->name('msc_report_health');
				Route::get('data', 'Wibs\Msc\Pages\ReportHealthController@getData')->name('msc_report_health_get_data');
			});

			Route::group(['prefix' => 'report-tahfidz'], function (){
				Route::get('/', 'Wibs\Msc\Pages\ReportTahfidzController@index')->name('msc_report_tahfidz');
				Route::get('data', 'Wibs\Msc\Pages\ReportTahfidzController@getData')->name('msc_report_tahfidz_get_data');
			});

			Route::group(['prefix' => 'report-hadis'], function (){
				Route::get('/', 'Wibs\Msc\Pages\ReportHadisController@index')->name('msc_report_hadis');
				Route::get('data', 'Wibs\Msc\Pages\ReportHadisController@getData')->name('msc_report_hadis_get_data');
			});

			Route::group(['prefix' => 'default'], function (){
				Route::get('/', 'Wibs\Msc\Pages\DefaultController@index')->name('msc_default');
				Route::get('data', 'Wibs\Msc\Pages\DefaultController@getData')->name('msc_default_get_data');
			});
		});
		
	});
});