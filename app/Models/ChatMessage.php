<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $fillable = [
        'user_id',
        'content'
    ];
    protected $with = ['author'];

    public function author() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
