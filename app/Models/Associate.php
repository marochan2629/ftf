<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Associate extends Authenticatable
{
    protected $fillable = [
        'name', 'email', 'age', 'religion_id', 'country', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
