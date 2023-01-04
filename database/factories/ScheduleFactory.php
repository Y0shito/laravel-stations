<?php

namespace Database\Factories;

use App\Models\Movie;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //現在から2週間後を先端、1週間前を後端とし、それぞれUNIXタイムスタンプへ
        $headDate = strtotime(CarbonImmutable::now()->addWeek(2));
        $rearDate = strtotime(CarbonImmutable::now()->subWeek(1));

        //上記の期間からランダムでstart_timeを生成、更にstart_timeの2時間後も生成
        $startTime = rand($headDate, $rearDate);
        $endTime = strtotime('+2 hours', $startTime);

        //DB挿入時にDATETIME型へ変換
        return [
            'movie_id' => Movie::select('id')->inRandomOrder()->first()->id,
            'screen_no' => $this->faker->numberBetween(1, 3),
            'start_time' => date('Y-m-d H:i:s', $startTime),
            'end_time' => date('Y-m-d H:i:s', $endTime),
        ];
    }
}
