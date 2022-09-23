<?php

use App\Models\User;

if (!function_exists('user')) {
    function user(): ?User
    {
        return auth()->user();
    }
}

if (! function_exists('price')) {
    function price($price): string
    {
        return number_format($price, 2, ',', '.');
    }
}