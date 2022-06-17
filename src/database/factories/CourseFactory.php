<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'shop_id' => $this->faker->numberBetween(1, 100),
            'name' => $this->faker->name(),
            'price' => $this->faker->numberBetween(3000, 10000)
        ];
    }
}
