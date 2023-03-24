<?php

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $reservations = Reservation::withoutGlobalScope('released_reservation')->get();
        foreach ($reservations as $reservation) {
            User::create(["name" => $reservation->name, "email" => $reservation->email]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        User::truncate();
    }
};
