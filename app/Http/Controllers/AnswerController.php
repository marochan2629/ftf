<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Associate;
use Illuminate\Support\Facades\DB; 

class AnswerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:associate');
    }

    public function create(Request $request, $id) {
        if (\Auth::guard('associate')->check()) {
            $question = Question::findOrFail($id);
            return view('associate.answer.create', compact('question'));
        } else {
            return redirect()->route('associate.login');
        }
    }

    public function store(Request $request)
    {
        $body = $request->body;
        $associate_id = Auth::guard('associate')->id();
        $question_id = $request->question_id;

        // 画像フォームでリクエストした画像を取得
        $img = $request->file('image');

        // 回答がセットされていれば、保存処理を実行
        if (isset($body)) {
            // storage > public > img配下に画像が保存される
            if(isset($img)) {
                $path = $img->store('img','public');
                Answer::create([
                    'body' => $body,
                    'image' => $path,
                    'associate_id' => $associate_id,
                    'question_id' => $question_id,
                ]);
            } else {
                Answer::create([
                    'body' => $body,
                    'associate_id' => $associate_id,
                    'question_id' => $question_id,
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