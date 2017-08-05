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
		Route::get('/', 'Wibs\Msc\Auth\AuthMscController@index')->name('msc_login');
		Route::get('/login', 'Wibs\Msc\Auth\AuthMscController@index')->name('login');
		Route::post('authenticate', 'Wibs\Msc\Auth\AuthMscController@authenticate')->name('msc_authenticate');
		Route::post('change-password', 'Wibs\Msc\Auth\AuthMscController@changePassword')->name('msc_change_password');
		Route::get('logout', 'Wibs\Msc\Auth\AuthMscController@logout')->name('msc_logout');

		Route::group(['prefix' => RouteMscLocation::setUsernameMscToSlug(), 'middleware' => ['auth', 'msc.privilege']], function (){

			Route::get('/', 'Wibs\Msc\Pages\DashboardMscController@index')->name('msc_dashboard');
			Route::get('data', 'Wibs\Msc\Pages\DashboardMscController@getData')->name('msc_get_data_siswa');
			Route::post('edit', 'Wibs\Msc\Pages\DashboardMscController@edit')->name('msc_edit_data_siswa');
			Route::post('store', 'Wibs\Msc\Pages\DashboardMscController@store')->name('msc_store_data_siswa');

			Route::group(['prefix' => 'student-monitoring'], function (){
				Route::get('/', 'Wibs\Msc\Pages\StudentMonitoringController@index')->name('msc_student_monitoring');
				Route::get('data', 'Wibs\Msc\Pages\StudentMonitoringController@getData')->name('msc_student_monitoring_get_data');
			});

			Route::group(['prefix' => 'quran-recitation'], function (){
				Route::get('/', 'Wibs\Msc\Pages\QuranRecitationReportController@index')->name('msc_quran_recitation');
				Route::get('data', 'Wibs\Msc\Pages\QuranRecitationReportController@getData')->name('msc_quran_recitation_get_data');
			});
		});
		
	});
});