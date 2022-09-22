<?php

use App\Http\Livewire\User\SecurityComponent;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;

it('should not be able to render component for guest', function () {
    $this->get(route('security-component'))
         ->assertRedirect(route('login'));
});

it('should be able to render component', function () {
    createUser();

    $this->get(route('security-component'))
         ->assertSuccessful()
         ->assertSeeLivewire('user.security-component');
});

it('should be able to change password', function () {
    $user = createUser([
        'password' => Hash::make('SEnh412345'),
    ]);

    Livewire::test(SecurityComponent::class)
        ->set('current', 'SEnh412345')
        ->set('password', 'Nov4SEnha12345')
        ->set('password_confirmation', 'Nov4SEnha12345')
        ->call('update')
        ->assertHasNoErrors();

    $user->refresh();

    $this->assertTrue(Hash::check('Nov4SEnha12345', $user->password));
});

it('should not be able to change password due validation error', function () {
    $user = createUser([
        'password' => bcrypt('SEnh412345'),
    ]);

    Livewire::test(SecurityComponent::class)
        ->set('current', 'SEnh412345')
        ->set('password', 'Nov4SEnha12345!@#')
        ->set('password_confirmation', 'Nov4SEnha12345')
        ->call('update')
        ->assertHasErrors('password');

    $user->refresh();

    $this->assertFalse(Hash::check('Nov4SEnha12345', $user->password));
});
