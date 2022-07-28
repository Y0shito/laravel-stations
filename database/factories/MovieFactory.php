<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->unique()->word,
            'image_url' => $this->faker->imageUrl(),
            'published_year' => $this->faker->numberBetween($min = 1940, $max = 2022),
            'is_showing' => $this->faker->numberBetween($min = 0, $max = 1),
            'description' => $this->faker->realTextBetween($minNbChars = 30, $maxNbChars = 100, $indexSize = 5),
            'created_at' => $this->faker->dateTime($max = 'now', $timezone = null),
            'updated_at' => $this->faker->dateTime($max = 'now', $timezone = null),
        ];
    }
}
