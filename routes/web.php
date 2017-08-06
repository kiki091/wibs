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

include __DIR__.'/msc/route.php';
include __DIR__.'/auth/route.php';

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
