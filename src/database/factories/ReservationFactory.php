<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Log;

class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date_time = $this->faker->dateTimeBetween($startData = '+1 day', $endDate = '+1 year');
        $date = $date_time->format('Y-m-d');
        $time = $date_time->format('H:i');
        return [
            'user_id' => $this->faker->numberBetween(1, 100),
            'shop_id' => $this->faker->numberBetween(1, 100),
            'date' => $date,
            'time' => $time,
            'number' => $this->faker->numberBetween(1, 100),
            'course_id' => $this->faker->numberBetween(1, 100),
            'rating_flg' => $this->faker->numberBetween(0, 1)
        ];
    }
}
