<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected $user_route  = 'user.login';
    protected $associate_route = 'associate.login';

    protected function redirectTo($request)
    {
        // ルーティングに応じて未ログイン時のリダイレクト先を振り分ける
        if (Route::is('photo.create', 'question.create')) {
            return route($this->user_route);
        } elseif (Route::is('article.create', 'article.edit', 'answer.create' ,'unanswered.questions')) {
            return route($this->associate_route);
        }
    }
}
