<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reposts', function (Blueprint $table) {    
            $table->bigIncrements('id');
            // ユーザid（外部キー）
            $table->unsignedBigInteger('user_id');
            // ポストid（外部キー）
            $table->unsignedBigInteger('post_id');
            // 違反理由
            $table->text('reason')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reposts');
    }
}
