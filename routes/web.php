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
    //complaint section
    Route::get('/', 'ComplainController@redirect');
    Route::get('/antrian-keluhan', 'ComplainController@index');
    Route::get('/keluhan-dalam-pengerjaan', 'ComplainController@inProgress');
    Route::get('/keluhan-selesai', 'ComplainController@complete');
    Route::post('/submit-complain', 'ComplainController@store');
    Route::delete('/delete-complain', 'ComplainController@destroy');
    Route::post('/get-complain', 'ComplainController@getComplain');

    //User Section
    Route::get('/daftar-user', 'UserController@userList');
    Route::post('/check-email', 'UserController@checkEmail');
    Route::post('/check-username', 'UserController@checkUsername');
    Route::post('/submit-user', 'UserController@store');
    Route::delete('/delete-user', 'UserController@destroy');
    Route::post('/check-edit-email', 'UserController@checkEditEmail');
    Route::post('/check-edit-username', 'UserController@checkEditUsername');
    Route::post('/update-user', 'UserController@update');
    Route::post('reset-password', 'UserController@resetPassword');

    //Unit Section
    Route::post('/user-submit-unit', 'UnitController@userStore');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
