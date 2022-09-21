<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id'        => User::factory(),
            'brand'          => $this->faker->word(),
            'model'          => $this->faker->word(),
            'color'          => $this->faker->safeColorName(),
            'identification' => str($this->faker->randomElement())->upper() . $this->faker->unique()->randomNumber(8),
        ];
    }
}
