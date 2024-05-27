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
        // 投稿と予約の関係は、1つの投稿に対して複数の予約を行う可能性があるため、1対多の関係
        return $this->belongsTo(Post::class);
        // return $this->belongsTo('App\Post');
        // 名前空間のエイリアス: use App\Post; を先頭に書くことで、コード内でPostクラスを使用する際にApp\Postを指定する必要がなくなります。これにより、コードが簡潔になります。
        // リファクタリングのしやすさ: もしPostクラスの名前空間が変更されたり、別のクラスに置き換えられたりした場合でも、Post::classを使用することで自動的に正しいクラスパスが参照されます。そのため、コードの保守性が向上します。
    }
}
