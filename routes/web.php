<?php

use App\Http\Controllers\HomeController;
use App\Http\Livewire\Attendance\AttendanceComponent;
use App\Http\Livewire\Parking\ParkingComponent;
use App\Http\Livewire\User\ProfileComponent;
use App\Http\Livewire\User\SecurityComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'auth.session'])
    ->group(function () {
        Route::get('/inicio', HomeController::class)->name('home');
        Route::get('/estacionamentos', ParkingComponent::class)->name('parking-component');
        Route::get('/atendimentos', AttendanceComponent::class)->name('attendance-component');

        Route::get('/perfil', ProfileComponent::class)->name('profile-component');
        Route::get('/seguranca', SecurityComponent::class)->name('security-component');
    });

require __DIR__ . '/auth.php';
