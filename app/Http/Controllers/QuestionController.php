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
    // indexは、回答がついた質問を表示するように変更。未回答の質問の表示は、answerコントローラーに記述。ビューもそれぞれ変更。
    public function index()
    {
        $questions = Question::whereNotNull('answer')->get();
        return view('app.question.index', compact('questions'));
    }

    public function show($id)
    {
        $question = Question::findOrFail($id);
            return view('app.question.show', compact('question'));
    }

    public function create() {

        if (\Auth::guard('user')->check()) {
            return view('app.question.create');
        } else {
            return redirect()->route('user.login');
        }
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

    public function create_answer(Request $request, $id) {
        if (\Auth::guard('associate')->check()) {
            $question = Question::findOrFail($id);
            return view('app.question.create_answer', compact('question'));
        } else {
            return redirect()->route('associate.login');
        }
    }

    public function store_answer(Request $request, $id)
    {
        $answer = $request->answer;

        // 画像フォームでリクエストした画像を取得
        $sup_img = $request->sup_image;

        // 画像情報がセットされていれば、保存処理を実行
        if (isset($answer)) {
            // storage > public > img配下に画像が保存される
            if(isset($sup_img)) {
                $path = $sup_img->store('img','public');
                Question::where("id", $id)->update([
                    'answer' => $answer,
                    'sup_image' => $path,
                ]);
            } else {
                Question::where("id", $id)->update([
                    'answer' => $answer,
                ]);
            }
        }

        return redirect()->route('question.index');
    }
}
