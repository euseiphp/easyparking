<?php

use App\Http\Livewire\ParkingComponent;
use App\Models\Parking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('should not be able to render component for guest', function () {
    $this->get(route('parking-component'))
         ->assertRedirect(route('login'));
});

it('should be able to render component', function () {
    createUser();

    $this->get(route('parking-component'))
         ->assertSuccessful()
         ->assertSeeLivewire('parking-component');
});

it('should be able to render parkings', function () {
    $user = createUser();

    $parking = Parking::factory()
        ->for($user)
        ->actived()
        ->create();

    $this->get(route('parking-component'))
         ->assertSee($parking->name)
         ->assertSee($parking->spaces);
});

it('should be able to create parking', function () {
    $user  = createUser();
    $faker = fake();

    $name     = $faker->name();
    $number   = rand(1, 20);
    $postcode = $faker->postcode();

    Livewire::test(ParkingComponent::class)
        ->set('createModal', true)
        ->set('create.name', $name)
        ->set('create.spaces', $number)
        ->set('postcode', $postcode)
        ->set('create.street', $faker->streetName())
        ->set('create.district', 'Centro')
        ->set('create.number', $number)
        ->set('create.city', $faker->city())
        ->set('create.state', 'SP')
        ->call('create')
        ->assertSuccessful();

    $this->assertDatabaseHas('parkings', [
        'user_id'  => $user->id,
        'name'     => $name,
        'number'   => $number,
        'postcode' => $postcode,
    ]);
});

it('should be able to edit parking', function () {
    $user = createUser();

    $parking = Parking::factory()
                      ->for($user)
                      ->actived()
                      ->create();

    $faker = fake();

    $name     = $faker->name();
    $number   = rand(1, 20);
    $postcode = $faker->postcode();

    $this->assertNotEquals($name, $parking->name);
    $this->assertNotEquals($number, $parking->spaces);
    $this->assertNotEquals($number, $parking->number);

    Livewire::test(ParkingComponent::class)
            ->set('editModal', true)
            ->call('append', $parking)
            ->set('edit.name', $name)
            ->set('edit.spaces', $number)
            ->set('postcode', $postcode)
            ->set('edit.street', $faker->streetName())
            ->set('edit.district', 'Centro')
            ->set('edit.number', $number)
            ->set('edit.city', $faker->city())
            ->set('edit.state', 'SP')
            ->call('edit')
            ->assertSuccessful();

    $parking->refresh();

    $this->assertEquals($name, $parking->name);
    $this->assertEquals($number, $parking->spaces);
    $this->assertEquals($number, $parking->number);
});

it('should be able to destroy parking', function () {
    $user = createUser();

    $parking = Parking::factory()
                      ->for($user)
                      ->actived()
                      ->create([
                          'name' => 'Espaço Novo',
                      ]);

    Livewire::test(ParkingComponent::class)
            ->call('destroy', [
                'selected' => $parking->id,
            ])->assertSuccessful();

    $this->assertModelMissing($parking);

    Livewire::test(ParkingComponent::class)->assertDontSee($parking->name);
});

it('should not be able to create parking with validation error', function () {
    $user = createUser();

    $faker  = fake();
    $number = rand(1, 20);

    Livewire::test(ParkingComponent::class)
            ->set('createModal', true)
            ->set('create.name', '')
            ->set('create.spaces', '')
            ->set('postcode', '00.000-000')
            ->set('create.street', $faker->streetName())
            ->set('create.district', 'Centro')
            ->set('create.number', $number)
            ->set('create.city', $faker->city())
            ->set('create.state', 'SP')
            ->call('create')
            ->assertHasErrors([
                'create.name',
                'create.spaces',
            ]);

    $this->assertDatabaseCount('parkings', 0);
});

it('should not be able to destroy parking from other user', function () {
    createUser();
    $doe = createUser(actingAs: false);

    $parking = Parking::factory()
                      ->for($doe)
                      ->actived()
                      ->create();

    Livewire::test(ParkingComponent::class)
            ->call('destroy', [
                'selected' => $parking->id,
            ])->assertDispatchedBrowserEvent('swal:common', [
                'type'    => 'error',
                'message' => 'Ops!',
                'text'    => 'Erro interno. Contate o suporte!',
            ]);

    $this->assertModelExists($parking);
});
