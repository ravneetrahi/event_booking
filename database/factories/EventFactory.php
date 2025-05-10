<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'start_time' => $this->faker->dateTimeBetween('+1 days', '+2 days'),
            'end_time' => $this->faker->dateTimeBetween('+2 days', '+3 days'),
            'capacity' => $this->faker->numberBetween(10, 100),
        ];
    }
}
