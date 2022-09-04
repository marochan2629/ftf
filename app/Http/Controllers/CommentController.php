<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use Illuminate\Support\Facades\DB; 

class CommentController extends Controller
{
    public function store(Request $request)
    {
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
