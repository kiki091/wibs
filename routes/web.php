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
	Route::group(['domain' => env('WORLD_WIDE_WEB') . env('ACCOUNT_DOMAIN_PREFIX')], function()
	{
		Route::get('/', 'Wibs\MainController@index')->name('login');
		Route::get('register', 'Wibs\Auth\AuthController@register')->name('register');
		Route::post('registered', 'Wibs\Auth\AuthController@registered')->name('registered');

		Route::post('auth', 'Wibs\Auth\AuthController@authenticate')->name('authenticate');
		Route::post('change-password', 'Wibs\Auth\AuthController@changePassword')->name('ChangePassword');
		Route::get('logout', 'Wibs\Auth\AuthController@logout')->name('logout');

		Route::group(['middleware' => ['auth', 'user.privilege']], function (){

			Route::group(['prefix' => RouteMenuLocation::setMenuLocation()], function () {

				Route::get('/', 'Wibs\Pages\DashboardController@index')->name('Dashboard');
			});
		});
	});
});