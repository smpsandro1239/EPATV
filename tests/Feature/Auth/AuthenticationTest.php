<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen()
    {
        /** @var User&Authenticatable $user */
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
            '_token' => csrf_token(),
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect(route('dashboard'));
    }

    public function test_users_can_be_not_authenticate_with_invalid_password()
    {
        /** @var User&Authenticatable $user */
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
            '_token' => csrf_token(),
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors();
    }

    public function test_users_can_logout()
    {
        /** @var User&Authenticatable $user */
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout', [
            '_token' => csrf_token(),
        ]);

        $this->assertGuest();
        $response->assertRedirect('/');
    }
}
