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
	Route::group(['domain' => env('WORLD_WIDE_WEB') . env('AUTH_DOMAIN_PREFIX') . env('APP_DOMAIN')], function()
	{
		Route::get('/', 'Wibs\Auth\AuthController@index')->name('users_login');
		Route::get('register', 'Wibs\Auth\AuthController@register')->name('users_register');
		Route::post('registered', 'Wibs\Auth\AuthController@registered')->name('users_registered');

		Route::post('auth', 'Wibs\Auth\AuthController@authenticate')->name('users_authenticate');
		Route::post('change-password', 'Wibs\Auth\AuthController@changePassword')->name('users_chenge_password');
		Route::get('logout', 'Wibs\Auth\AuthController@logout')->name('users_logout');

		Route::group(['middleware' => ['users', 'auth.privilege']], function (){

			Route::group(['prefix' => RouteUsersLocation::setUsersLocation()], function () {

				Route::get('/', 'Wibs\Auth\DashboardController@index')->name('users_dashboard');

				// CMS MANAGEMENT ROUTE

				Route::group(['prefix' => 'santri'], function () {

					Route::get('/', 'Wibs\Auth\Pages\SantriController@index')->name('cms_santri');
					Route::get('data', 'Wibs\Auth\Pages\SantriController@getData')->name('cms_get_data_santri');
					Route::get('search-data', 'Wibs\Auth\Pages\SantriController@searchData')->name('cms_get_search_data_santri');
					Route::post('store', 'Wibs\Auth\Pages\SantriController@store')->name('cms_store_data_santri');
					Route::post('edit', 'Wibs\Auth\Pages\SantriController@edit')->name('cms_edit_data_santri');
					Route::post('change-status', 'Wibs\Auth\Pages\SantriController@changeStatus')->name('cms_change_status_data_santri');
				});

				Route::group(['prefix' => 'wali-santri'], function () {

					Route::get('/', 'Wibs\Auth\Pages\WaliSiswaController@index')->name('cms_wali_santri');
					Route::get('data', 'Wibs\Auth\Pages\WaliSiswaController@getData')->name('cms_get_data_wali_santri');
					Route::get('search-data', 'Wibs\Auth\Pages\WaliSiswaController@searchData')->name('cms_get_search_data_santri');
					Route::post('store', 'Wibs\Auth\Pages\WaliSiswaController@store')->name('cms_store_data_wali_santri');
					Route::post('edit', 'Wibs\Auth\Pages\WaliSiswaController@edit')->name('cms_edit_data_wali_santri');
					Route::post('change-status', 'Wibs\Auth\Pages\WaliSiswaController@change-status')->name('cms_change_status_data_wali_santri');
				});

				Route::group(['prefix' => 'report'], function () {
					
					Route::group(['prefix' => 'quran'], function () {
						Route::get('/', 'Wibs\Auth\Pages\ReportQuranController@index')->name('cms_report_quran');
						Route::get('data', 'Wibs\Auth\Pages\ReportQuranController@getData')->name('cms_report_quran_data');
						Route::post('edit', 'Wibs\Auth\Pages\ReportQuranController@edit')->name('cms_report_quran_edit_data');
						Route::post('store', 'Wibs\Auth\Pages\ReportQuranController@store')->name('cms_report_quran_store_data');
					});

					Route::group(['prefix' => 'kesehatan'], function () {
						Route::get('/', 'Wibs\Auth\Pages\ReportKesehatanController@index')->name('cms_report_kesehatan');
						Route::get('data', 'Wibs\Auth\Pages\ReportKesehatanController@getData')->name('cms_report_kesehatan_data');
						Route::post('edit', 'Wibs\Auth\Pages\ReportKesehatanController@edit')->name('cms_report_kesehatan_edit_data');
						Route::post('store', 'Wibs\Auth\Pages\ReportKesehatanController@store')->name('cms_report_kesehatan_store_data');
					});

					Route::group(['prefix' => 'hadis'], function () {
						Route::get('/', 'Wibs\Auth\Pages\ReportHadisController@index')->name('cms_report_hadis');
						Route::get('data', 'Wibs\Auth\Pages\ReportHadisController@getData')->name('cms_report_hadis_data');
						Route::post('edit', 'Wibs\Auth\Pages\ReportHadisController@edit')->name('cms_report_hadis_edit_data');
						Route::post('store', 'Wibs\Auth\Pages\ReportHadisController@store')->name('cms_report_hadis_store_data');
					});
				});
				// ACCOUNT MANAGEMENT ROUTE

				Route::group(['prefix' => 'ams'], function () {

					// MENU GROUP MANAGEMENT ROUTE

					Route::group(['prefix' => 'menu-group'], function ()
					{
						Route::get('/', 'Wibs\Auth\MenuGroupController@index')->name('CmsMenuGroupManager');
						Route::get('data', 'Wibs\Auth\MenuGroupController@getData')->name('CmsMenuGroupManagerGetData');
						Route::post('change-status', 'Wibs\Auth\MenuGroupController@changeStatus')->name('CmsMenuGroupManagerChangeStatus');
					});

					// MENU NAVIGATION MANAGEMENT ROUTE

					Route::group(['prefix' => 'menu-navigation'], function ()
					{
						Route::get('/', 'Wibs\Auth\MenuNavigationController@index')->name('CmsMenuNavigation');
						Route::get('data', 'Wibs\Auth\MenuNavigationController@getData')->name('CmsMenuNavigationGetData');
						Route::post('change-status', 'Wibs\Auth\MenuNavigationController@changeStatus')->name('CmsMenuNavigationChangeStatus');
					});

					// SUB MENU NAVIGATION MANAGEMENT ROUTE

					Route::group(['prefix' => 'sub-menu-navigation'], function ()
					{
						Route::get('/', 'Wibs\Auth\SubMenuNavigationController@index')->name('CmsSubMenuNavigation');
						Route::get('data', 'Wibs\Auth\SubMenuNavigationController@getData')->name('CmsSubMenuNavigationGetData');
						Route::post('change-status', 'Wibs\Auth\SubMenuNavigationController@changeStatus')->name('CmsSubMenuNavigationChangeStatus');
					});

					// USER ACCOUNT MANAGEMENT ROUTE

					Route::group(['prefix' => 'user-account'], function ()
					{
						Route::get('/', 'Wibs\Auth\UserAccountController@index')->name('CmsUserAccount');
						Route::get('data', 'Wibs\Auth\UserAccountController@getData')->name('CmsUserAccountGetData');
						Route::post('change-status', 'Wibs\Auth\UserAccountController@changeStatus')->name('CmsUserAccountChangeStatus');
						Route::post('store', 'Wibs\Auth\UserAccountController@store')->name('CmsUserAccountStoreData');
						Route::post('edit', 'Wibs\Auth\UserAccountController@edit')->name('CmsUserAccountEditData');
					});
				});
			});
		});
		
	});
});
