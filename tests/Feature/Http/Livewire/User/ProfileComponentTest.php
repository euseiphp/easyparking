<?php

use App\Http\Livewire\User\ProfileComponent;
use Livewire\Livewire;

it('should not be able to render component for guest', function () {
    $this->get(route('profile-component'))
         ->assertRedirect(route('login'));
});

it('should be able to render component', function () {
    $user = createUser();

    $this->get(route('profile-component'))
         ->assertSuccessful()
         ->assertSee($user->only('name', 'email', 'phone'))
         ->assertSeeLivewire('user.profile-component');
});

it('should be able to update profile', function () {
    $user = createUser();

    $fake = fake();

    $name  = $fake->name();
    $phone = $fake->phoneNumber();

    Livewire::test(ProfileComponent::class)
        ->set('name', $name)
        ->set('phone', $phone)
        ->call('update');

    $user->refresh();

    $this->assertEquals($name, $user->name);
    $this->assertEquals($phone, $user->phone);
});

it('should not be able to update email', function () {
    $user = createUser();

    $fake = fake();

    $name  = $fake->name();
    $phone = $fake->phoneNumber();

    Livewire::test(ProfileComponent::class)
        ->set('name', $name)
        ->set('phone', $phone)
        ->set('email', 'jhon@jhon.com')
        ->call('update');

    $user->refresh();

    $this->assertNotEquals('jhon@jhon.com', $user->email);
});

it('should not be able to update profile due validation error', function () {
    createUser();

    Livewire::test(ProfileComponent::class)
        ->set('name', '')
        ->set('phone', '012345678912345678901')
        ->call('update')
        ->assertHasErrors(['name', 'phone']);
});
