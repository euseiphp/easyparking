<?php

namespace Database\Seeders;

use App\Models\Attendance;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $user = user();

        Attendance::factory(20)
            ->progress()
            ->create();
    }
}
