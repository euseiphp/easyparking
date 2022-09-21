<?php

use App\Http\Controllers\HomeController;
use App\Http\Livewire\ParkingComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/inicio', HomeController::class)->name('home');
    Route::get('/estacionamentos', ParkingComponent::class)->name('parking-component');
});

require __DIR__ . '/auth.php';
