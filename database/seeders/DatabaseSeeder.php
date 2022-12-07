<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([MovieSeeder::class, SheetsSeeder::class, ScheduleSeeder::class, ReservationSeeder::class]);
        // $this->call([MovieSeeder::class, SheetsSeeder::class, ScheduleSeeder::class]);
    }
}
