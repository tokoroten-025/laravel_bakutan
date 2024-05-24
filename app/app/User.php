<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Http\Request;

class User extends Authenticatable
{
    use Notifiable;
    // ロール定数の定義
    const ROLE_ADMIN = 1;
    const ROLE_RYOKAN = 2;
    const ROLE_GENERAL = 10;
    
    /**
     * パスワードリセット通知の送信
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\CustomResetPasswordNotification($token));
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'icon',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // 投稿
    public function post(){
        return $this -> hasMany('App\Post','user_id','id');
    }
    
     // 予約
    public function booking(){
        return $this -> hasMany('App\Booking','user_id','id');
    }

    public function store(Request $request)
    {
        $data = $request->input('email');
        // ここで$dataを処理する
    }

    /**
     * ユーザーが一般ユーザーかどうかを判定
     */
    public function isGeneralUser()
    {
        return $this->role == self::ROLE_GENERAL;
    }

    /**
     * ユーザーが旅館ユーザーかどうかを判定
     */
    public function isRyokanUser()
    {
        return $this->role == self::ROLE_RYOKAN;
    }
}

