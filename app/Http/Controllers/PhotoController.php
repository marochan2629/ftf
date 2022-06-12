<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Config; 

class PhotoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:associate,user');
    }

    public function index()
    {
        $photos = Photo::get();
        return view('app.photo.index', compact('photos'));
    }

    public function create(Request $request)
    {
        if (\Auth::guard('user')->check() || \Auth::guard('associate')->check()) {
            return view('app.photo.create');
        } else {
            return redirect()->route('user.login');
        }
    }

    public function store(Request $request)
    {
        $user_id = Auth::id();
        $name = $request->name;

        // 画像フォームでリクエストした画像を取得
        $img = $request->file('image');

        // 画像情報がセットされていれば、保存処理を実行
        if (isset($img)) {
            // storage > public > img配下に画像が保存される
            $path = $img->store('img','public');

            // store処理が実行できたらDBに保存処理を実行
            if ($path) {
                // DBに登録する処理
                Photo::create([
                    'name' => $name,
                    'image' => $path,
                    'user_id' => $user_id,
                ]);
            }
        }

        return redirect()->route('photo.index');
    }
}
