<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use App\Models\User;
use Illuminate\Support\Facades\DB; 
// use Illuminate\Support\Facades\Config; 

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::get();
        return view('app.question.index', compact('questions'));
    }

    public function create() {
        return view('app.question.create');
    }

    // public function store() {
    //     return view('app.question.create');
    // }

    public function store(Request $request)
    {
        $title = $request->title;
        // dd($title);
        $body = $request->body;
        $user_id = Auth::id();

        // 画像フォームでリクエストした画像を取得
        $img = $request->file('image');

        // 画像情報がセットされていれば、保存処理を実行
        if (isset($title, $body)) {
            // storage > public > img配下に画像が保存される
            if(isset($img)) {
                $path = $img->store('img','public');
                Question::create([
                    'title' => $title,
                    'body' => $body,
                    'image' => $path,
                    'user_id' => $user_id,
                ]);
            } else {
                Question::create([
                    'title' => $title,
                    'body' => $body,
                    'user_id' => $user_id,
                ]);
            }

            // store処理が実行できたらDBに保存処理を実行
            // if ($path) {
                // DBに登録する処理
            // }
        }

        // dd('title');

        return redirect()->route('question.index');
    }
}
