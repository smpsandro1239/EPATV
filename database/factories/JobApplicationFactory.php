<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobApplicationFactory extends Factory
{
    protected $model = \App\Models\JobApplication::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'job_id' => Job::factory(),
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'course_completion_year' => $this->faker->year,
            'cv' => 'cvs/sample.pdf',
            'message' => $this->faker->paragraph,
            'status' => 'pending',
        ];
    }
}
