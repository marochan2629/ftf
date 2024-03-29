<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'title',
        'body',
        'image',
        'answer',
        'sup_image',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
