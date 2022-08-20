<?php

use App\Models\Question;

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

// aboutページ
Route::get('/about', 'MainController@about')->name('ftf.about');

// プライバシーポリシー
Route::get('/policy', 'MainController@policy')->name('ftf.policy');

// 写真投稿関係
Route::get('/photo/index', 'PhotoController@index')->name('photo.index');
Route::get('/photo/index/search', 'PhotoController@search')->name('photo.search');
Route::get('/photo/create', 'PhotoController@create')->name('photo.create');
Route::post('/photo/confirm', 'PhotoController@store')->name('photo.store');

// 質問関係
Route::get('/question/index', 'QuestionController@index')->name('question.index');
Route::get('/question/index/search', 'QuestionController@search')->name('question.search');
Route::get('/question/show/{id}', function($id) {
    $question = Question::findOrFail($id);
    if (!$question->answer) {
        abort(403, '未回答の質問です');
    } else {
        $question = Question::findOrFail($id);
        return view('app.question.show', compact('question'));
    }
})->name('question.show');
Route::get('/question/create', 'QuestionController@create')->name('question.create');
Route::post('/question/create', 'QuestionController@store')->name('question.store');

// 回答関係
Route::get('/question/answer/{id}', 'QuestionController@create_answer')->name('answer.create');
Route::patch('/question/answer/{id}', 'QuestionController@store_answer')->name('answer.store');

// 記事関係
Route::get('/article/index', 'ArticleController@index')->name('article.index');
Route::get('/article/index/search', 'ArticleController@search')->name('article.search');
Route::get('/article/index/tag-search', 'ArticleController@tagSearch')->name('article.tag-search');
Route::get('/article/show/{id}', 'ArticleController@show')->name('article.show');
Route::post('/article/show/{id}', 'ArticleController@like')->name('article.like');
Route::get('/article/create', 'ArticleController@create')->name('article.create');
Route::post('/article/create', 'ArticleController@store')->name('article.store');

// コメント関係
Route::post('/comment/store', 'CommentController@store')->name('comment.store');

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
        Route::resource('home', 'UserHomeController', ['only' => ['index', 'mypage']]);
        // Route::get('/mypage', 'UserHomeController@mypage')->name('user.mypage');
        // Route::view('mypage', 'app.mypage')->name('mypage');
        Route::get('/show/{id}', 'UserHomeController@show')->name('mypage');

    });
});

// 管理者
Route::prefix('associate')->name('associate.')->group(function () {

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