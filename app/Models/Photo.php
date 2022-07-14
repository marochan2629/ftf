<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'name',
        'image',
        'description',
        'user_id',
        'associate_id',
    ];

    //追記
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}