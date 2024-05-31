<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('likes', function (Blueprint $table) {
        $table->timestamps();
    });
}

public function down()
{
    Schema::table('likes', function (Blueprint $table) {
        $table->dropColumn(['created_at', 'updated_at']);
    });
}
}
