<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
