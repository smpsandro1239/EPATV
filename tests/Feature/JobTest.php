<?php

namespace Tests\Feature;

use App\Models\AreaOfInterest;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JobTest extends TestCase
{
    use RefreshDatabase;

    public function test_company_can_create_job()
    {
        /** @var User&Authenticatable $company */
        $company = User::factory()->create(['role' => 'company']);
        $area = AreaOfInterest::factory()->create();

        $response = $this->actingAs($company)->post('/jobs', [
            'title' => 'Software Engineer',
            'category_id' => $area->id,
            'description' => 'Develop software solutions',
            'location' => 'Lisbon',
            'contract_type' => 'full-time',
            'expiration_date' => now()->addDays(30)->toDateTimeString(),
            '_token' => $this->app->make('session')->token(),
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('jobs', [
            'title' => 'Software Engineer',
            'company_id' => $company->id,
            'category_id' => $area->id,
        ]);
    }
}