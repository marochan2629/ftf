<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Article;
use App\Models\Photo;

class Associate extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'age', 'religion', 'country', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }

    public function photos()
    {
        return $this->hasMany('App\Models\Photo');
    }

}
