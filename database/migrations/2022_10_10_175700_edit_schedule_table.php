<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            DB::statement("ALTER TABLE schedules MODIFY start_time DATETIME COMMENT '上映開始時刻'");
            DB::statement("ALTER TABLE schedules MODIFY end_time DATETIME COMMENT '上映終了時刻'");
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
            DB::statement("ALTER TABLE schedules MODIFY start_time TIME COMMENT '上映開始時刻'");
            DB::statement("ALTER TABLE schedules MODIFY end_time TIME COMMENT '上映終了時刻'");
        });
    }
};
