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
            $table->dropColumn(['name', 'email']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->string('email', 255)->after('sheet_id')->comment('予約者メールアドレス');
            $table->string('name', 255)->after('email')->comment('予約者名');
        });

        DB::table('reservations')
            ->join('users', 'users.id', '=', 'reservations.user_id')
            ->update([
                'reservations.name' => DB::raw('users.name'),
                'reservations.email' => DB::raw('users.email'),
            ]);

        DB::statement('ALTER TABLE reservations
            MODIFY COLUMN name VARCHAR(255) NOT NULL,
            MODIFY COLUMN email VARCHAR(255) NOT NULL;'
            );
    }
};
