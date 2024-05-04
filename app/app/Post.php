<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    //モデルに関連付けるテーブル
    protected $table = 'posts';

    //可変項目
    protected $fillable = 
    [
        'title',
        'availability_guests',
        'availability_days',
        'content',
        'amount',
    ];
    // 予約
    public function booking(){
        return $this -> hasMany('App\Booking','post_id','id');
    }
    
}
