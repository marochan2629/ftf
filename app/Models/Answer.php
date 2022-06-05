<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'body',
        'image',
        'associate_id',
        'question_id',
    ];

    public function question()
    {
        return $this->belongsTo('App\Models\Question');
    }

    public function associate()
    {
        return $this->hasOne('App\Models\Associate'); 
    }
}
