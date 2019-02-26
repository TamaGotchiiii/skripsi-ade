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
    Route::post('/update-complain', 'ComplainController@updateComplain');
    Route::post('/take-complain', 'ComplainController@takeComplain');
    Route::get('/keluhan-diselesaikan', 'ComplainController@completed');
    Route::post('/complain-done', 'ComplainController@done');
    Route::get('/download-attachment/{id}', 'ComplainController@download');
    Route::get('/laporan-keluhan/{y}', 'ComplainController@report');

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
    Route::post('/get-user', 'UserController@getUser');
    Route::post('/change-password', 'UserController@changePassword');

    //Unit Section
    Route::post('/user-submit-unit', 'UnitController@userStore');
    Route::get('/daftar-unit', 'UnitController@unitList');
    Route::post('/check-unit', 'UnitController@checkUnit');
    Route::post('/add-unit', 'UnitController@addUnit');
    Route::post('/get-unit', 'UnitController@getUnit');
    Route::delete('/delete-unit', 'UnitController@deleteUnit');
    Route::post('/check-edit-unit', 'UnitController@checkEditUnit');
    Route::post('/update-unit', 'UnitController@updateUnit');

    //Attachment Section
    Route::delete('delete-attachment', 'AttachmentController@destroy');
});

Route::get('login', [
    'as' => 'login',
    'uses' => 'Auth\LoginController@showLoginForm',
  ]);
  Route::post('login', [
    'as' => '',
    'uses' => 'Auth\LoginController@login',
  ]);
  Route::post('logout', [
    'as' => 'logout',
    'uses' => 'Auth\LoginController@logout',
  ]);
