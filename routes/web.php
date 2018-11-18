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
Route::fallback(function () {
    return redirect('/');
});

Auth::routes();
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register')->middleware('r');
Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request')->middleware('r');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset')->middleware('r');

Route::get('/', 'HomeController@index')->name('home')->middleware('r');
Route::get('/home', 'HomeController@index')->name('home')->middleware('r');

Route::group(['middleware' => ['loggedin']], function () {
	Route::get('/dashboard', 'admin\index');
	Route::resource('/menu/admin', 'admin\menu');
	Route::resource('/menu/client', 'admin\menu');
	Route::resource('/poster', 'admin\poster');
	Route::resource('/file', 'admin\file');
});