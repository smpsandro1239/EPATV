<?php

namespace Tests\Feature;

use App\Models\Job;
use App\Models\User;
use App\Notifications\ApplicationReceived;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class JobApplicationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
        Notification::fake();
    }

    public function test_student_can_submit_job_application()
    {
        /** @var User&Authenticatable $student */
        $student = User::factory()->create(['role' => 'student']);
        /** @var User&Authenticatable $company */
        $company = User::factory()->create(['role' => 'company']);
        $job = Job::factory()->create(['company_id' => $company->id]);

        $cv = UploadedFile::fake()->create('my_cv.pdf', 100, 'application/pdf');
        $response = $this->actingAs($student)->post(route('jobs.apply', $job), [
            'cv' => $cv,
            'message' => 'Applying for this job.',
            '_token' => csrf_token(),
        ]);

        $response->assertRedirect()->assertSessionHas('success', 'Candidatura enviada com sucesso!');
        $this->assertDatabaseHas('job_applications', [
            'user_id' => $student->id,
            'job_id' => $job->id,
            'status' => 'pending',
        ]);
        $application = \App\Models\JobApplication::first();
        $this->assertFileExists(Storage::disk('public')->path($application->cv));
        Notification::assertSentTo($company, ApplicationReceived::class);
    }

    public function test_non_student_cannot_submit_application()
    {
        /** @var User&Authenticatable $company */
        $company = User::factory()->create(['role' => 'company']);
        $job = Job::factory()->create(['company_id' => $company->id]);

        $response = $this->actingAs($company)->post(route('jobs.apply', $job), [
            'cv' => UploadedFile::fake()->create('cv.pdf', 100, 'application/pdf'),
            'message' => 'Unauthorized attempt.',
            '_token' => csrf_token(),
        ]);

        $response->assertRedirect()->assertSessionHas('error', 'Apenas estudantes podem candidatar-se a vagas.');
        $this->assertDatabaseCount('job_applications', 0);
    }

    public function test_student_cannot_submit_duplicate_application()
    {
        /** @var User&Authenticatable $student */
        $student = User::factory()->create(['role' => 'student']);
        /** @var User&Authenticatable $company */
        $company = User::factory()->create(['role' => 'company']);
        $job = Job::factory()->create(['company_id' => $company->id]);

        $this->actingAs($student)->post(route('jobs.apply', $job), [
            'cv' => UploadedFile::fake()->create('cv.pdf', 1000, 'application/pdf'),
            'message' => 'First application.',
            '_token' => csrf_token(),
        ]);

        $response = $this->actingAs($student)->post(route('jobs.apply', $job), [
            'cv' => UploadedFile::fake()->create('cv2.pdf', 1000, 'application/pdf'),
            'message' => 'Duplicate application.',
            '_token' => csrf_token(),
        ]);

        $response->assertRedirect()->assertSessionHas('error', 'Você já se candidatou a esta vaga.');
        $this->assertDatabaseCount('job_applications', 1);
    }

    public function test_application_fails_with_invalid_cv()
    {
        /** @var User&Authenticatable $student */
        $student = User::factory()->create(['role' => 'student']);
        $job = Job::factory()->create();

        $response = $this->actingAs($student)->post(route('jobs.apply', $job), [
            'cv' => UploadedFile::fake()->create('cv.txt', 1000, 'text/plain'),
            'message' => 'Invalid CV.',
            '_token' => csrf_token(),
        ]);

        $response->assertSessionHasErrors('cv');
        $this->assertDatabaseMissing('job_applications', [
            'user_id' => $student->id,
            'job_id' => $job->id,
        ]);
    }

    public function test_application_fails_with_oversized_cv()
    {
        /** @var User&Authenticatable $student */
        $student = User::factory()->create(['role' => 'student']);
        $job = Job::factory()->create();

        $response = $this->actingAs($student)->post(route('jobs.apply', $job), [
            'cv' => UploadedFile::fake()->create('cv.pdf', 3000, 'application/pdf'),
            'message' => 'Oversized CV.',
            '_token' => csrf_token(),
        ]);

        $response->assertSessionHasErrors('cv');
        $this->assertDatabaseMissing('job_applications', [
            'user_id' => $student->id,
            'job_id' => $job->id,
        ]);
    }

    public function test_unauthenticated_user_cannot_submit_application()
    {
        $job = Job::factory()->create();

        $response = $this->post(route('jobs.apply', $job), [
            'cv' => UploadedFile::fake()->create('cv.pdf', 1000, 'application/pdf'),
            'message' => 'Unauthorized attempt.',
            '_token' => csrf_token(),
        ]);

        $response->assertRedirect(route('login'));
        $this->assertDatabaseCount('job_applications', 0);
    }

    public function test_notification_is_sent_to_company()
    {
        /** @var User&Authenticatable $student */
        $student = User::factory()->create(['role' => 'student']);
        /** @var User&Authenticatable $company */
        $company = User::factory()->create(['role' => 'company']);
        $job = Job::factory()->create(['company_id' => $company->id]);

        $this->actingAs($student)->post(route('jobs.apply', $job), [
            'cv' => UploadedFile::fake()->create('cv.pdf', 1000, 'application/pdf'),
            'message' => 'Test application.',
            '_token' => csrf_token(),
        ]);

        Notification::assertSentTo($company, ApplicationReceived::class, function ($notification) use ($job) {
            return $notification->application->job_id === $job->id;
        });
    }

    public function test_cannot_apply_to_expired_job()
    {
        /** @var User&Authenticatable $student */
        $student = User::factory()->create(['role' => 'student']);
        $job = Job::factory()->create(['company_id' => User::factory()->create(['role' => 'company'])->id, 'expiration_date' => now()->subDay()]);

        $response = $this->actingAs($student)->post(route('jobs.apply', $job), [
            'cv' => UploadedFile::fake()->create('cv.pdf', 1000, 'application/pdf'),
            'message' => 'Applying to expired job.',
            '_token' => csrf_token(),
        ]);

        $response->assertRedirect()->assertSessionHas('error', 'Esta vaga já expirou.');
        $this->assertDatabaseCount('job_applications', 0);
    }
}
