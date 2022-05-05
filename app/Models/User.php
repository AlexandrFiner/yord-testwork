<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;

    protected $fillable = [
        'email',
        'password'
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function messages() {
        $this->hasMany(ChatMessage::class, 'user_id', 'id');
    }
}
