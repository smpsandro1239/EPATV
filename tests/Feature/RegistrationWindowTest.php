<?php

namespace Tests\Feature;

use App\Models\RegistrationWindow;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationWindowTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_registration_windows()
    {
        /** @var User&Authenticatable $admin */
        $admin = User::factory()->create(['role' => 'admin']);
        RegistrationWindow::factory()->create(['is_active' => true]);

        $response = $this->actingAs($admin)->get(route('registration-windows.index'));

        $response->assertStatus(200);
        $response->assertViewHas('windows');
    }

    public function test_admin_can_create_registration_window()
    {
        /** @var User&Authenticatable $admin */
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post(route('registration-windows.store'), [
            'is_active' => true,
            'start_time' => now()->toDateTimeString(),
            'end_time' => now()->addDays(7)->toDateTimeString(),
            'max_registrations' => 100,
            'password' => 'secret123',
            '_token' => csrf_token(),
        ]);

        $response->assertRedirect(route('registration-windows.index'))
            ->assertSessionHas('success', 'Janela de registro criada!');
        $this->assertDatabaseHas('registration_windows', [
            'is_active' => true,
            'max_registrations' => 100,
        ]);
    }

    public function test_admin_can_update_registration_window()
    {
        /** @var User&Authenticatable $admin */
        $admin = User::factory()->create(['role' => 'admin']);
        $window = RegistrationWindow::factory()->create();

        $response = $this->actingAs($admin)->put(route('registration-windows.update', $window), [
            'is_active' => false,
            'start_time' => now()->toDateTimeString(),
            'end_time' => now()->addDays(7)->toDateTimeString(),
            'max_registrations' => 50,
            'password' => 'newsecret',
            '_token' => csrf_token(),
        ]);

        $response->assertRedirect(route('registration-windows.index'))
            ->assertSessionHas('success', 'Janela de registro atualizada!');
        $this->assertDatabaseHas('registration_windows', [
            'id' => $window->id,
            'is_active' => false,
            'max_registrations' => 50,
        ]);
    }

    public function test_admin_can_delete_registration_window()
    {
        /** @var User&Authenticatable $admin */
        $admin = User::factory()->create(['role' => 'admin']);
        $window = RegistrationWindow::factory()->create();

        $response = $this->actingAs($admin)->delete(route('registration-windows.destroy', $window), [
            '_token' => csrf_token(),
        ]);

        $response->assertRedirect(route('registration-windows.index'))
            ->assertSessionHas('success', 'Janela de registro eliminada!');
        $this->assertDatabaseMissing('registration_windows', ['id' => $window->id]);
    }

    public function test_non_admin_cannot_access_registration_windows()
    {
        /** @var User&Authenticatable $student */
        $student = User::factory()->create(['role' => 'student']);

        $response = $this->actingAs($student)->get(route('registration-windows.index'));

        $response->assertStatus(403);
    }
}
