<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            // 投稿id
            $table->bigIncrements('id');
            // ユーザid。外部キー
            $table->unsignedBigInteger('user_id');
            // users テーブルの id に対する外部キー制約
            $table->foreign('user_id')->references('id')->on('users'); 
            // タイトル
            $table->string('title', 100);
            // 予約可能人数。NULL を許可。
            $table->string('num_of_guests')->nullable();
            // 予約可能日。NULL を許可。
            $table->date('s')->nullable(); 
            $table->date('s')->nullable(); 
            // 内容
            $table->text('content', 500);
            // 金額
            $table->integer('amount');
            // 画像のファイルパス。※NULL許可
            $table->string('image')->nullable();
            // 投稿日時と更新日時を管理するためのタイムスタンプ。
            $table->dateTime('reservation_datetime')->unique();
            $table->timestamp('created_at')->upuseCurrent(); // Use current timestamp for 'created_at'
            $table->timestamp('updated_at')->nullable(); // Allow 'updated_at' to be nullable
            // 論理削除。デフォルト値 0。
            $table->integer('del_flg')->default(0); 
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
