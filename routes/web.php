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
Route::resource('v1', 'UserController');

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix'=>'admin'],function(){
Route::get('/login','Authadmin\LoginController@showLoginForm')->name('admin.login');
Route::post('/login','Authadmin\LoginController@login')->name('admin.login.submit');
Route::get('/', 'adminController@index')->name('admin.home');
});

