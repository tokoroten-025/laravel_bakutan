<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //データ書きかえを許可するための記述(6-2P10参照)
    protected $fillable = ['user_id', 'post_id'];

    //テーブル結合(user_idとid) 
    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
    
    //テーブル結合(post_idとid) 
    public function post(){
        return $this->belongsTo('App\Post','post_id','id');
    }

    //【いいね機能】いいねされてるかどうかの確認
    //                        　   ↓otherDetail.phpから渡されたAuth:user()->idと$otherIdを受け取ってる
    public function like_exist($user_id, $post_id) {        
        //Likeテーブル内に、絞り込んだデータがあるかチェックする
        return Like::where('user_id', $user_id)->where('post_id', $post_id)->exists();       
    }
}
