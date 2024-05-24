<?php

namespace App;
use App\Post;


use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    // モデルに関連付けるテーブル
    protected $table = 'bookings';

    public $timestamps = true;


    // 予約が所属する投稿を取得
    public function post()
    {
        return $this->belongsTo('App\Post');
        // 投稿と予約の関係は、1つの投稿に対して複数の予約を行う可能性があるため、1対多の関係
    }
}
