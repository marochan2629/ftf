<?php

use App\Models\Question;
use Illuminate\Support\Facades\Auth;

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
})->name('top');

// aboutページ
Route::get('/about', 'MainController@about')->name('ftf.about');

// プライバシーポリシー
Route::get('/policy', 'MainController@policy')->name('ftf.policy');

// 写真投稿関係
Route::get('/photo/index', 'PhotoController@index')->name('photo.index');
Route::get('/photo/index/search', 'PhotoController@search')->name('photo.search');
Route::middleware('auth:user,associate')->get('/photo/create', 'PhotoController@create')->name('photo.create');
Route::post('/photo/confirm', 'PhotoController@store')->name('photo.store');

// 質問関係
Route::get('/question/index', 'QuestionController@index')->name('question.index');
Route::get('/question/index/search', 'QuestionController@search')->name('question.search');
Route::get('/question/show/{id}', function($id) {
    $question = Question::findOrFail($id);
    if (!$question->answer && Auth::guard('associate')->id() == null) {
        abort(403, '未回答の質問です');
    } elseif(!$question->answer && Auth::guard('associate')->id() !== null) {
        return view('app.question.create_answer', compact('question'));
    } else {
        return view('app.question.show', compact('question'));
    }
})->name('question.show');
Route::middleware('auth:user')->get('/question/create', 'QuestionController@create')->name('question.create');
Route::post('/question/create', 'QuestionController@store')->name('question.store');
Route::middleware('auth:associate')->get('/question/unanswered', 'QuestionController@unanswered')->name('unanswered.questions');

// 回答関係
Route::middleware('auth:associate')->get('/question/answer/{id}', 'QuestionController@create_answer')->name('answer.create');
Route::patch('/question/answer/{id}', 'QuestionController@store_answer')->name('answer.store');

// 記事関係
Route::get('/article/index', 'ArticleController@index')->name('article.index');
Route::get('/article/index/search', 'ArticleController@search')->name('article.search');
Route::get('/article/index/tag-search', 'ArticleController@tagSearch')->name('article.tag-search');
Route::get('/article/show/{id}', 'ArticleController@show')->name('article.show');
Route::post('/article/show/{id}', 'ArticleController@like')->name('article.like');
Route::middleware('auth:associate')->get('/article/edit/{id}', 'ArticleController@edit')->name('article.edit');
Route::post('/article/edit/{id}', 'ArticleController@update')->name('article.update');
Route::middleware('auth:associate')->get('/article/create', 'ArticleController@create')->name('article.create');
Route::post('/article/create', 'ArticleController@store')->name('article.store');
Route::post('/article/delete/{id}/', 'ArticleController@delete');

// コメント関係
Route::middleware('auth:user')->post('/comment/store', 'CommentController@store')->name('comment.store');

// ユーザー
Route::prefix('user')->name('user.')->group(function () {

    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'reset'    => false,
        'verify'   => false
    ]);

    // ログイン認証後
    // Route::middleware('auth:user')->group(function () {

    Route::resource('home', 'UserHomeController', ['only' => ['index', 'show', 'update']]);
    Route::get('/show/{id}', 'UserHomeController@show')->name('mypage');

    // UserHomeControllerってログイン認証しないと使えないの？別にログインしないでもよくない？
    Route::patch('/show/{id}', 'UserHomeController@update')->name('mypage.update');

    // });
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
    Route::get('/show/{id}', 'AssociateHomeController@show')->name('mypage');

    // ログイン認証後
    Route::middleware('auth:associate')->group(function () {

        // TOPページ
        // Route::resource('home', 'AssociateHomeController', ['only' => 'index']);  この1行が必要なさそうなのでコメントアウト。resource使ってるくせにonly indexってなに？しかもindexページ無いし(10/29)
        Route::patch('/show/{id}', 'AssociateHomeController@update')->name('mypage.update');

    });
});