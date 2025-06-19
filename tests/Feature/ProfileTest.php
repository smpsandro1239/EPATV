<?php

use App\Models\User;


test('profile page is displayed', function () {
    // Usa RefreshDatabase para limpar o banco após o teste


    $user = User::factory()->create([
        'email' => 'unique_' . uniqid() . '@example.com', // Email único
    ]);

    $response = $this
        ->actingAs($user)
        ->get('/profile');

    $response->assertOk();
});

test('profile information can be updated', function () {


    $user = User::factory()->create([
        'email' => 'unique_' . uniqid() . '@example.com',
    ]);

    $response = $this
        ->actingAs($user)
        ->patch('/profile', [
            'name' => 'Test User',
            'email' => 'updated_' . uniqid() . '@example.com', // Email único para atualização
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/profile');

    $user->refresh();

    $this->assertSame('Test User', $user->name);
    $this->assertStringStartsWith('updated_', $user->email);
    $this->assertNull($user->email_verified_at);
});

test('email verification status is unchanged when the email address is unchanged', function () {


    $user = User::factory()->create([
        'email' => 'unique_' . uniqid() . '@example.com',
        'email_verified_at' => now(),
    ]);

    $response = $this
        ->actingAs($user)
        ->patch('/profile', [
            'name' => 'Test User',
            'email' => $user->email,
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/profile');

    $this->assertNotNull($user->refresh()->email_verified_at);
});

test('user can delete their account', function () {


    $user = User::factory()->create([
        'email' => 'unique_' . uniqid() . '@example.com',
        'password' => bcrypt('password'),
    ]);

    $response = $this
        ->actingAs($user)
        ->delete('/profile', [
            'password' => 'password',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/');

    $this->assertGuest();
    $this->assertNull($user->fresh());
});

test('correct password must be provided to delete account', function () {


    $user = User::factory()->create([
        'email' => 'unique_' . uniqid() . '@example.com',
        'password' => bcrypt('password'),
    ]);

    $response = $this
        ->actingAs($user)
        ->from('/profile')
        ->delete('/profile', [
            'password' => 'wrong-password',
        ]);

    $response
        ->assertSessionHasErrorsIn('userDeletion', 'password')
        ->assertRedirect('/profile');

    $this->assertNotNull($user->fresh());
});
