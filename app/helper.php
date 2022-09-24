<?php

use App\Models\User;

if (!function_exists('user')) {
    function user(): ?User
    {
        return auth()->user();
    }
}

if (!function_exists('price')) {
    function price($price): string
    {
        return number_format($price, 2, ',', '.');
    }
}

if (!function_exists('random')) {
    function random(string $type = 'number', int $length = 8): string
    {
        return match ($type) {
            'number' => substr(str_shuffle(str_repeat('123456789', ceil($length / strlen('123456789')))), 0, $length),
            'crypto' => bin2hex(random_bytes($length / 2)),
            default  => (string) mt_rand(),
        };
    }
}
