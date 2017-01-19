<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use Carbon\Carbon;
use App\Patient;

Auth::routes();
Route::resource('posts', 'PostController');
Route::resource('checkup', 'CheckupController');
Route::resource('immunization', 'ImmunizeController');
Route::resource('sms', 'SmsController');
Route::get('search', [
    'as' => 'posts.search', 'uses' => 'PostController@search'
]);


Route::post('user_filter', [
    'as' => 'sms.filter', 'uses' => 'SmsController@filter'
]);

Route::get('pdf/{id}', [
    'as' => 'posts.pdf', 'uses' => 'PostController@pdf'
])->middleware('UserAndAdmin');

Route::get('userlogin', [
    'as' => 'user.login', 'uses' => 'UserAuth\UserLoginController@login'
]);

Route::post('usercheck', [
    'as' => 'user.check', 'uses' => 'UserAuth\UserLoginController@check'
]);

Route::post('userlogout', [
    'as' => 'user.logout', 'uses' => 'UserAuth\UserLoginController@logout'
]);


Route::get('home', [
    'as' => 'user.index', 'uses' => 'UserAuth\UserLoginController@index'
])->middleware('checksession');

Route::get('/', function(){
	return view('auth/login');
});

Route::resource('add', 'MedicalPersonnelController');
Route::resource('report', 'ReportController');

Route::post('reportpdf', [
    'as' => 'report.pdf', 'uses' => 'ReportController@pdf'
]);