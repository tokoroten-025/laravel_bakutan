<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repost extends Model
{
    // 
    public $timestamps = false;
    protected $fillable = [
        'post_id',
        'user_id',
        'reason',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
