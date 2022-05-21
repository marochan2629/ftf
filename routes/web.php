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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('associate')->group(function () {
    Route::get('/login', 'Auth\AssociateLoginController@showLoginForm')->name('associate.login');
    Route::post('/login', 'Auth\AssociateLoginController@login')->name('associate.login');
    Route::post('/logout', 'Auth\AssociateLoginController@logout')->name('associate.logout');
    Route::get('/', 'Auth\AssociateController@index')->name('associate.index');
});