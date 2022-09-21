<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        Model::unguard();

        View::share('routes', [
            'Inicio'          => 'home',
            'Estacionamentos' => 'parking-component',
        ]);
    }
}
