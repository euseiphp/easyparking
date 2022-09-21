<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateUser
{
    public function __invoke(array $data): ?User
    {
        return DB::transaction(function () use ($data) {
            return User::query()
                ->create([
                    'name'     => data_get($data, 'name'),
                    'email'    => data_get($data, 'email'),
                    'phone'    => data_get($data, 'phone'),
                    'password' => Hash::make(data_get($data, 'password')),
                ]);
        });
    }
}
