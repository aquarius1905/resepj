<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ShopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'area_id' => $this->faker->numberBetween(1, 3),
            'genre_id' => $this->faker->numberBetween(1, 5),
            'representative_id' => $this->faker->numberBetween(1, 100),
            'name' => $this->faker->name(),
            'overview' => $this->faker->realText(),
            'img_filename' => $this->faker->image()
        ];
    }
}
