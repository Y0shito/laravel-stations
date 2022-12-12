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
        $scheduleIds = Schedule::all()->pluck('id');
        $sheetIds = Sheet::all()->pluck('id');

        $matrix = $scheduleIds->crossJoin($sheetIds);
        $keyPair = $this->faker->unique()->randomElement($matrix);

        return [
            'screening_date' => Schedule::select('start_time')->find($keyPair[0])->start_time,
            'schedule_id' => $keyPair[0],
            'sheet_id' =>  $keyPair[1],
            'email' => $this->faker->safeEmail(),
            'name' => $this->faker->name(),
        ];
    }
}
