<?php

namespace App\Http\Livewire\User;

use App\Http\Livewire\Traits\SweetAlert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;
use Throwable;

class SecurityComponent extends Component
{
    use SweetAlert;

    public string $current = '';

    public string $password = '';

    public string $password_confirmation = '';

    public function render()
    {
        return view('livewire.user.security-component');
    }

    public function rules(): array
    {
        return [
            'current' => [
                'required',
                'current_password',
            ],
            'password' => [
                'required',
                'confirmed',
                Password::defaults()
                        ->letters()
                        ->numbers()
                        ->mixedCase(),
            ],
        ];
    }

    public function update()
    {
        $this->validate();

        Auth::logoutOtherDevices($this->current);

        try {
            DB::transaction(function () {
                user()->update([
                    'password' => Hash::make($this->password),
                ]);
            });

            return $this->successAlert();
        } catch (Throwable $e) {
            //
        }

        return $this->errorAlert();
    }
}
