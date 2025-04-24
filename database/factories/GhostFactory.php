<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GhostFactory extends Factory
{

    public function definition(): array
    {
        return [
            'data' => fake()->text(100),

            'user_id' => random_int(1, 3000),
        ];
    }
}
