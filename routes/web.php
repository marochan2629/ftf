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
    return view('app.home');
});

// Route::get('/associate/home', 'AssociateController@home')->name('associate.home');
// Route::get('/index', 'HomeController@index');
// Auth::routes();

// ユーザー
Route::prefix('user')->name('user.')->group(function () {

    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'reset'    => false,
        'verify'   => false
    ]);

    // ログイン認証後
    Route::middleware('auth:user')->group(function () {

        // TOPページ
        Route::resource('home', 'UserHomeController', ['only' => 'index']);

    });
});

// 管理者
Route::prefix('associate')->name('associate.')->group(function () {

    // ログイン認証関連
    // Auth::routes([
    //     'register' => true,
    //     'reset'    => false,
    //     'verify'   => false
    // ]);

    Route::get('login', 'Auth\AssociateLoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\AssociateLoginController@login');
    Route::post('logout', 'Auth\AssociateLoginController@logout')->name('logout');

    Route::get('register', 'Auth\AssociateRegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\AssociateRegisterController@register');

    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

    // ログイン認証後
    Route::middleware('auth:associate')->group(function () {

        // TOPページ
        Route::resource('home', 'AssociateHomeController', ['only' => 'index']);

    });
});

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
