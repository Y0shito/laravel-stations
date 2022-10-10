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
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropColumn('start_time', 'end_time');
            $table->date('start_time_date')->comment('開始日付')->after('movie_id');
            $table->time('start_time_time')->comment('開始時間')->after('start_time_date');
            $table->date('end_time_date')->comment('終了日付')->after('start_time_time');
            $table->time('end_time_time')->comment('終了時間')->after('end_time_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropColumn('start_time_date', 'start_time_time', 'end_time_date', 'end_time_time');
            $table->time('start_time')->comment('上映開始時刻')->after('movie_id');
            $table->time('end_time')->comment('上映終了時刻')->after('start_time');
        });
    }
};
