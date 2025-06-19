<?php



test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {


    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'unique_' . uniqid() . '@example.com', // Email único
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});
