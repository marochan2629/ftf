<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;

use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Models\Tag;
use App\Models\Associate;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\Support\Facades\DB; 

class ArticleController extends Controller
{

    public function index()
    {
        $articles = Article::get();
        $keyword = '';
        return view('app.article.index', compact('articles', 'keyword'));
    }
    
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $query = Article::query();

        if(!empty($keyword)) {
            $query->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('body', 'LIKE', "%{$keyword}%");
        }

        $articles = $query->get();

        return view('app.article.index', compact('articles', 'keyword'));
    }

    public function show($id)
    {
        $article = Article::withCount('likes')->findOrFail($id);
        $comments = Comment::with('article')->where('article_id', $id)->get();

        // dd($comments);

        return view('app.article.show', compact('article', 'comments'));
    }

    public function create() {
        if (\Auth::guard('associate')->check()) {
            return view('app.article.create');
        } else {
            return redirect()->route('associate.login');
        }
    }

    public function store(ArticleRequest $request)
    {
        $title = $request->title;
        $body = $request->body;
        preg_match_all('/#([a-zA-Z0-9０-９ぁ-んァ-ヶー一-龠]+)/', $request->tags, $match);
        $associate_id = Auth::guard('associate')->id();

        // 画像フォームでリクエストした画像を取得
        $img = $request->file('image');

        // 画像情報がセットされていれば、保存処理を実行
        if (isset($title, $body)) {
            // storage > public > img配下に画像が保存される
            if(isset($img)) {
                $path = $img->store('img','public');
                $article = Article::create([
                    'title' => $title,
                    'body' => $body,
                    'image' => $path,
                    'associate_id' => $associate_id,
                ]);
            } else {
                $article = Article::create([
                    'title' => $title,
                    'body' => $body,
                    'associate_id' => $associate_id,
                ]);
            }
        }

        if($request->tags != null) {
            $tags = [];
            foreach($match[1] as $tag) {
                $record = Tag::firstOrCreate(['name' => $tag]);
                array_push($tags, $record);
            }
         
            $tag_ids = [];
            foreach($tags as $tag) {
                array_push($tag_ids, $tag->id);
            }

            $article->tags()->sync($tag_ids);
        }

        return redirect()->route('article.index');
    }

    public function like(Request $request)
    {
        $user_id = Auth::user()->id; //1.ログインユーザーのid取得
        $article_id = $request->article_id; //2.投稿idの取得
        $already_liked = Like::where('user_id', $user_id)->where('article_id', $article_id)->first(); //3.

        if (!$already_liked) { //もしこのユーザーがこの投稿にまだいいねしてなかったら
            $like = new Like; //4.Likeクラスのインスタンスを作成
            $like->article_id = $article_id; //Likeインスタンスにarticle_id,user_idをセット
            $like->user_id = $user_id;
            $like->save();
        } else { //もしこのユーザーがこの投稿に既にいいねしてたらdelete
            Like::where('article_id', $article_id)->where('user_id', $user_id)->delete();
        }
        //5.この投稿の最新の総いいね数を取得
        $article_likes_count = Article::withCount('likes')->findOrFail($article_id)->likes_count;
        $param = [
            'article_likes_count' => $article_likes_count,
        ];
        return response()->json($param); //6.JSONデータをjQueryに返す
    }
}
