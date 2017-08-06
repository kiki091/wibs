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
