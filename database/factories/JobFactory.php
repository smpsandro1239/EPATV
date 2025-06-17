<?php

namespace Database\Factories;

use App\Models\AreaOfInterest;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    protected $model = \App\Models\Job::class;

    public function definition()
    {
        return [
            'company_id' => User::factory()->state(['role' => 'company']),
            'title' => $this->faker->jobTitle,
            'category_id' => AreaOfInterest::factory(),
            'description' => $this->faker->paragraph,
            'location' => $this->faker->city,
            'salary' => $this->faker->randomFloat(2, 30000, 100000),
            'contract_type' => $this->faker->randomElement(['full-time', 'part-time', 'internship', 'freelance']),
            'expiration_date' => $this->faker->dateTimeBetween('now', '+1 month'),
        ];
    }
}
