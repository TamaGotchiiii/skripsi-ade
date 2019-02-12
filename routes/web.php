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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'ComplainController@redirect');
    Route::get('/antrian-keluhan', 'ComplainController@index');
    Route::get('/keluhan-dalam-pengerjaan', 'ComplainController@inProgress');
    Route::get('/keluhan-selesai', 'ComplainController@complete');
    Route::get('/daftar-user', 'UserController@userList');
    Route::post('/check-email', 'UserController@checkEmail');
    Route::post('/check-username', 'UserController@checkUsername');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
