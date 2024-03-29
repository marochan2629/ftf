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
use Storage;

class ArticleController extends Controller
{

    public function index()
    {
        // 記事を取得して２０件ずつ表示
        $articles = Article::paginate(20);
        
        // 最新記事を５件取得
        $latest_articles = Article::orderBy('id', 'desc')->take(5)->get();

        // 検索ワードを設定
        $keyword = '';

        return view('app.article.index', compact('articles', 'latest_articles', 'keyword'));
    }
    
    public function search(Request $request)
    {
        // キーワードをリクエストから取得
        $keyword = $request->input('keyword');
        
        // キーワードから記事を検索
        $query = Article::query();
        if(!empty($keyword)) {
            $query->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('body', 'LIKE', "%{$keyword}%");
        }

        $articles = $query->paginate(20);

        $latest_articles = Article::orderBy('id', 'desc')->take(5)->get();

        return view('app.article.index', compact('articles', 'latest_articles', 'keyword'));
    }

    public function tagSearch(Request $request)
    {
        $keyword = $request->input('keyword');
        $query = Article::query();

        if(!empty($keyword)) {
            $query = Article::whereHas('tags', function ($query) use ($keyword) {
                $query->where('name', 'LIKE', "%{$keyword}%");
            });
        }

        $articles = $query->paginate(20);
        $latest_articles = Article::orderBy('id', 'desc')->take(5)->get();
        $keyword = '';

        return view('app.article.index', compact('articles', 'latest_articles', 'keyword'));
    }

    public function show($id)
    {
        $article = Article::withCount('likes')->findOrFail($id);
        $comments = Comment::with('article')->where('article_id', $id)->get();

        return view('app.article.show', compact('article', 'comments'));
    }

    public function create() {
        return view('app.article.create');
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
            if(isset($img)) {
                $path = Storage::disk('s3')->putFile('/', $img);

                $article = Article::create([
                    'title' => $title,
                    'body' => $body,
                    'image' => Storage::disk('s3')->url($path),
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

    public function edit($id){
        $article = Article::find($id);

        // タグ名格納用の空の配列を定義
        $tag_name = array();

        // 記事に紐づいているタグを取得し、foreachでタグ名のみを配列に格納
        foreach ($article->tags as $tag){
            array_push($tag_name, $tag->name);
        }

        // コンマで区切られている配列の中身を連結して文字列に
        $tag_name = implode(",", $tag_name);

        //この時点の文字列は各タグ名がコンマで区切られた状態なので、タグ名を#に置換
        $tag_name = str_replace( ',' , '#' , $tag_name);

        //文字列の先頭に#が無いので#を挿入
        $tag_name = substr_replace($tag_name, '#', 0, 0);

        return view('app.article.edit', compact('article', 'tag_name'));
    }

    public function update(ArticleRequest $request ,$id){
        $title = $request->title;
        $body = $request->body;
        preg_match_all('/#([a-zA-Z0-9０-９ぁ-んァ-ヶー一-龠]+)/', $request->tags, $match);
        $associate_id = Auth::guard('associate')->id();

        // 画像フォームでリクエストした画像を取得
        $img = $request->file('image');

        // 画像情報がセットされていれば、保存処理を実行
        if (isset($title, $body)) {
            if(isset($img)) {
                $path = Storage::disk('s3')->putFile('/', $img);

                $article = Article::where('id', $id)->update([
                    'title' => $title,
                    'body' => $body,
                    'image' => Storage::disk('s3')->url($path),
                    'associate_id' => $associate_id,
                ]);
            } else {
                $article = Article::where('id', $id)->update([
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

            $article = Article::where('id', $id)->first();
            $article->tags()->sync($tag_ids);
        }

        return redirect()->route('article.index');
    }

    public function delete($id){
        //削除対象レコードを検索
        $article = Article::find($id);
        //削除
        $article->delete();
        //リダイレクト
        return redirect()->route('article.index');
    }
}
