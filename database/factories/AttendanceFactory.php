<?php

namespace Database\Factories;

use App\Enum\AttendanceStatus;
use App\Models\Car;
use App\Models\Parking;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AttendanceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id'     => User::factory(),
            'car_id'      => Car::factory(),
            'parking_id'  => Parking::factory()->actived(),
            'service_id'  => Service::factory()->actived(),
            'description' => $this->faker->sentence(),
            'price'       => $this->faker->randomFloat(2, 0, 1000),
        ];
    }

    public function progress(): self
    {
        return $this->state(fn () => [
            'status' => AttendanceStatus::InProgress,
        ]);
    }

    public function complete(): self
    {
        return $this->state(fn () => [
            'status' => AttendanceStatus::Completed,
        ]);
    }

    public function finished(Carbon $carbon): self
    {
        return $this->state(fn () => [
            'finished_at' => $carbon,
        ]);
    }
}
