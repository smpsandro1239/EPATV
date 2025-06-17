<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AreaOfInterestFactory extends Factory
{
    protected $model = \App\Models\AreaOfInterest::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
