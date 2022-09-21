<?php

namespace App\Http\Controllers\Auth;

use App\Actions\User\CreateUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Throwable;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
        try {
            $user = (new CreateUser())($request->validated());

            event(new Registered($user));

            Auth::login($user);

            return redirect()->intended(RouteServiceProvider::HOME);
        } catch (Throwable $e) {
            //
        }

        return redirect()
            ->back()
            ->with('error', 'Erro interno. Tente novamente!')
            ->withInput();
    }
}
