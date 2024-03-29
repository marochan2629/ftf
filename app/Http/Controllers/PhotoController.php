<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Config; 
use App\Http\Requests\PhotoRequest;
use Storage;

class PhotoController extends Controller
{
    public function index()
    {
        $keyword = '';
        $photos = Photo::get();
        return view('app.photo.index', compact('photos', 'keyword'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $query = Photo::query();

        if(!empty($keyword)) {
            $query->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('description', 'LIKE', "%{$keyword}%");
        }

        $photos = $query->get();

        return view('app.photo.index', compact('photos', 'keyword'));
    }

    public function create()
    {
        return view('app.photo.create');
    }

    public function store(PhotoRequest $request)
    {
        $user_id = Auth::guard('user')->id();
        $associate_id = Auth::guard('associate')->id();
        $name = $request->name;

        // 画像フォームでリクエストした画像を取得
        $img = $request->file('image');
        $description = $request->description;

        // 画像情報がセットされていれば、保存処理を実行
        if (isset($img)) {
            // S3に画像が保存される
            $path = Storage::disk('s3')->putFile('/', $img);

            // store処理が実行できたらDBに保存処理を実行
            if ($path) {
                // DBに登録する処理
                Photo::create([
                    'name' => $name,
                    'image' => Storage::disk('s3')->url($path),
                    'description' => $description,
                    'user_id' => $user_id,
                    'associate_id' => $associate_id,
                ]);
            }
        }

        return redirect()->route('photo.index');
    }
}
