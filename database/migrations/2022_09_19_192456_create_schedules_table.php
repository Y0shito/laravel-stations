<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id()->comment('ID');
            $table->unsignedBigInteger('movie_id')->comment('列');
            $table->time('start_time')->comment('上映開始時刻');
            $table->time('end_time')->comment('上映終了時刻');
            $table->dateTime('created_at')->nullable()->comment('作成日時');
            $table->dateTime('updated_at')->nullable()->comment('更新日時');

            $table->foreign('movie_id')->references('id')->on('movies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
};
