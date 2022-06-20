<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Middleware\Authenticate;
// use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
// use App\Models\Associate;
// use App\Models\Like;
use Illuminate\Support\Facades\DB; 

class CommentController extends Controller
{
    public function store(Request $request)
    {
        if (!\Auth::guard('user')->check()) {
            return redirect()->route('user.login');
        }

        // dd($request);

        $body = $request->body;
        $article_id = $request->article_id;
        $user_id = Auth::guard('user')->id();

        if (isset($body)) {
            $comment = Comment::create([
                'body' => $body,
                'article_id' => $article_id,
                'user_id' => $user_id,
            ]);
        }

        return redirect()->back();
    }
}
