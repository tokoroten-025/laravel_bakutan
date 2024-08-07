<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            // ユーザid（外部キー）
            $table->unsignedBigInteger('user_id');
            // ポストid（外部キー）
            $table->unsignedBigInteger('post_id');
            // 電話番号
            $table->string('tel')->nullable();
            // メールアドレス
            $table->string('email');
            // 宿泊人数
            $table->integer('num_of_guests')->default(1);
            // 宿泊開始日。
            $table->date('checkindate');             
            // 宿泊終了日。
            $table->date('checkoutdate');
            // タイムスタンプの追加
            $table->timestamps();
            // 予約をした日時
            $table->dateTime('reservation_datetime')->default(DB::raw('CURRENT_TIMESTAMP'));

            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('post_id')->references('id')->on('posts');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
// ALTER TABLE `bookings` DROP INDEX `bookings_email_unique`;
// 結局、↑で削除した