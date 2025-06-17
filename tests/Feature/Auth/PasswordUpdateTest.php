<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PasswordUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_password_can_be_updated()
    {
        /** @var User&Authenticatable $user */
        $user = User::factory()->create(['password' => bcrypt('password')]);

        $response = $this->actingAs($user)->put('/password', [
            'current_password' => 'password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
            '_token' => csrf_token(),
        ]);

        $response->assertSessionHasNoErrors()->assertRedirect('/profile');

        expect(Hash::check('new-password', $user->fresh()->password))->toBeTrue();
    }

    public function test_correct_password_must_be_provided_to_update_password()
    {
        /** @var User&Authenticatable $user */
        $user = User::factory()->create(['password' => bcrypt('password')]);

        $response = $this->actingAs($user)->put('/password', [
            'current_password' => 'wrong-password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
            '_token' => csrf_token(),
        ]);

        $response->assertSessionHasErrors('current_password')->assertRedirect('/profile');
    }
}
