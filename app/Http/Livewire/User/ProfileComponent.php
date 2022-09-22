<?php

namespace App\Http\Livewire\User;

use App\Http\Livewire\Traits\SweetAlert;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Throwable;

class ProfileComponent extends Component
{
    use SweetAlert;

    public User $user;

    public string $name;

    public string $email;

    public string $phone;

    protected $listeners = [
        'profile::component::refresh' => '$refresh',
    ];

    public function mount()
    {
        $this->user = user();

        $this->name  = $this->user->name;
        $this->email = $this->user->email;
        $this->phone = $this->user->phone;
    }

    public function render()
    {
        return view('livewire.user.profile-component');
    }

    public function rules()
    {
        return collect((new RegisterRequest())->rules())
            ->except(['password', 'email'])
            ->toArray();
    }

    public function update()
    {
        $this->validate();

        try {
            DB::transaction(function () {
                $this->user
                    ->update([
                        'name'  => $this->name,
                        'phone' => $this->phone,
                    ]);
            });

            $this->emit('header::refresh');

            return $this->successAlert();
        } catch (Throwable $e) {
            //
        }

        return $this->successAlert();
    }
}
