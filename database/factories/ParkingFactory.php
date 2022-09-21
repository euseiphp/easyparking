<?php

namespace Database\Factories;

use App\Enum\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ParkingFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id'  => User::factory(),
            'name'     => $this->faker->word(),
            'street'   => $this->faker->streetName(),
            'district' => 'Boa Vista',
            'number'   => rand(1, 100),
            'city'     => $this->faker->city(),
            'state'    => 'Bahia',
            'postcode' => $this->faker->postcode(),
            'spaces'   => rand(1, 100),
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
