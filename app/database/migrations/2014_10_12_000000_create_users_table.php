<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            // 名前
            $table->string('name,20');
            // メールアドレス
            $table->string('email,50')->unique();
            // パスワード
            $table->string('password,100');
            // アイコンは必須ではない
            $table->string('icon')->nullable();
            // 論理削除。デフォルト値 0。
            $table->integer('del_flg')->default(0);
            // ユーザータイプ。コメントに一般、旅館、管理の値
            $table->tinyInteger('role')->default(0)->integer('一般=0,旅館=1,管理=2');
            // リセットトークンってなに！
            $table->string('reset_token');

            // 作成日時と更新日時を管理するためのタイムスタンプ。
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}