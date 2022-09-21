<?php

namespace Database\Factories;

use App\Enum\Status;
use App\Models\Parking;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'parking_id'  => Parking::factory()->actived(),
            'name'        => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'price'       => $this->faker->randomFloat(2, 0, 100),
        ];
    }

    public function actived(): self
    {
        return $this->state(fn () => [
            'status' => Status::Actived,
        ]);
    }

    public function deactived(): self
    {
        return $this->state(fn () => [
            'status' => Status::Deactived,
        ]);
    }
}
