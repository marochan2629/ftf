<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use App\Models\User;
use Illuminate\Support\Facades\DB; 
use App\Http\Requests\QuestionRequest;
use Storage;

class QuestionController extends Controller
{
    // indexは、回答がついた質問を表示するように変更。未回答の質問の表示は、answerコントローラーに記述。ビューもそれぞれ変更。
    public function index()
    {
        $questions = Question::whereNotNull('answer')->get();
        $keyword = '';

        return view('app.question.index', compact('questions', 'keyword'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $query = Question::query();

        if(!empty($keyword)) {
            $query->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('body', 'LIKE', "%{$keyword}%");
        }

        $questions = $query->paginate(20);

        return view('app.question.index', compact('questions', 'keyword'));
    }

    public function show($id)
    {
        $question = Question::findOrFail($id);
        return view('app.question.show', compact('question'));
    }

    public function create()
    {
        return view('app.question.create');
    }

    public function store(QuestionRequest $request)
    {   
        $title = $request->title;
        $body = $request->body;
        $user_id = Auth::id();

        // 画像フォームでリクエストした画像を取得
        $img = $request->file('image');

        // 画像情報がセットされていれば、保存処理を実行
        if (isset($title, $body)) {
            // S3に画像が保存される
            if(isset($img)) {
                $path = Storage::disk('s3')->putFile('/', $img);

                Question::create([
                    'title' => $title,
                    'body' => $body,
                    'image' => Storage::disk('s3')->url($path),
                    'user_id' => $user_id,
                ]);
            } else {
                Question::create([
                    'title' => $title,
                    'body' => $body,
                    'user_id' => $user_id,
                ]);
            }
        }

        return redirect()->route('question.index');
    }

    public function create_answer($id)
    {
        $question = Question::findOrFail($id);
        return view('app.question.create_answer', compact('question'));
    }

    public function store_answer(QuestionRequest $request, $id)
    {
        $answer = $request->answer;
        // 画像フォームでリクエストした画像を取得
        $sup_img = $request->sup_image;

        // 回答がセットされていれば、保存処理を実行
        if (isset($answer)) {
            // S3に画像が保存される
            if(isset($sup_img)) {
                $path = Storage::disk('s3')->putFile('/', $sup_img);

                Question::where("id", $id)->update([
                    'answer' => $answer,
                    'sup_image' => Storage::disk('s3')->url($path),
                ]);
            } else {
                Question::where("id", $id)->update([
                    'answer' => $answer,
                ]);
            }
        }

        return redirect()->route('question.index');
    }

    public function unanswered()
    {
        $questions = Question::whereNull('answer')->get();
        $keyword = '';
        return view('app.question.unanswered', compact('questions', 'keyword'));
    }
}
