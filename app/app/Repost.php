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
        'resolved'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'reported_user_id' => 'required|exists:users,id',
    //         'reason' => 'required|string|max:255',
    //     ]);

    //     Repost::create([
    //         'user_id' => auth()->id(),
    //         'reported_user_id' => $request->reported_user_id,
    //         'reason' => $request->reason,
    //     ]);

    //     return redirect()->route('ryokan.mypage')->with('success', '違反報告が送信されました。');
    // }
}
