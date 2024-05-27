<?php

namespace App;
use App\Booking;
use Illuminate\Database\Eloquent\Model;
use App\Repost;

class Post extends Model
{
    //
    //モデルに関連付けるテーブル
    protected $table = 'posts';

    //可変項目
    protected $fillable = 
    [
        'title',
        'num_of_guests',
        'checkindate',
        'checkoutdate',
        'image',
        'content',
        'amount',
        'del_flg',
    ];
    
    // 予約
    public function booking(){
        // return $this->hasMany('App\Booking', 'post_id', 'id');
        return $this->hasMany(Booking::class, 'post_id', 'id');
    }

    // 違反報告
    public function reposts()
    {
        return $this->hasMany(Repost::class, 'post_id', 'id');
    }

    // いいね
    public function likes(){
        return $this->hasMany('App\Like');
    }
    
}
