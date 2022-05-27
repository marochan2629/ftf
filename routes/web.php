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

// Route::prefix('associate')->group(function () {
//     Route::get('/register', 'Auth\AssociateRegisterController@showAssociateRegistrationForm')->name('associate.register');
//     Route::post('/register', 'Auth\AssociateRegisterController@register');
//     Route::get('/login', 'Auth\AssociateLoginController@showLoginForm')->name('associate.login');
//     Route::post('/login', 'Auth\LoginController@login')->name('associate.login');
//     Route::post('/logout', 'Auth\AssociateLoginController@logout')->name('associate.logout');
//     Route::get('/', 'Auth\AssociateController@index')->name('associate.index');
// });

Route::get('associate/register', 'Auth\AssociateRegisterController@showAssociateRegistrationForm')->name('associate.register');
Route::post('associate/register', 'Auth\AssociateRegisterController@register');
Route::get('associate/login', 'Auth\AssociateLoginController@showLoginForm')->name('associate.login');
Route::post('associate/login', 'Auth\LoginController@login')->name('associate.login');
Route::post('associate/logout', 'Auth\AssociateLoginController@logout')->name('associate.logout');
Route::get('associate/', 'Auth\AssociateController@index')->name('associate.index');