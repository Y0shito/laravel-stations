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
        Schema::table('reservations', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('screening_date')->comment('ユーザーID')->constrained();
        });

        DB::table('reservations')
            ->join('users', function ($join) {
                $join->on('reservations.name', '=', 'users.name')
                    ->on('reservations.email', '=', 'users.email');
            })
            ->update(['reservations.user_id' => DB::raw('users.id')]);

        DB::statement('ALTER TABLE reservations MODIFY user_id BIGINT UNSIGNED NOT NULL;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
