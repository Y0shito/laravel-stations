<?php

namespace Database\Factories;

use App\Models\Sheet;
use App\Models\Schedule;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $scheduleId = Schedule::select('id')->inRandomOrder()->first()->id;
        $date = Schedule::select('start_time')->find($scheduleId)->start_time;

        return [
            'date' => $date,
            'schedule_id' => $scheduleId,
            'sheet_id' =>  Sheet::select('id')->inRandomOrder()->first()->id,
            'email' => $this->faker->safeEmail(),
            'name' => $this->faker->name(),
        ];
    }
}
