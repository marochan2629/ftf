<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Like;

class Article extends Model
{
    protected $fillable = [
        'title',
        'body',
        'image',
        'associate_id',
    ];

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag','article_tag');
    }

    public function associate()
    {
        return $this->belongsTo('App\Models\Associate');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }

    //いいねされているかを判定するメソッド。
    public function isLikedBy($user): bool {
        return Like::where('user_id', $user->id)->where('article_id', $this->id)->first() !==null;
    }
}
