<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        Job::create([
            'company_id' => 1, // Usa um ID de empresa válido
            'title' => 'Desenvolvedor PHP',
            'category_id' => 1, // Usa um ID de categoria válido
            'description' => 'Vaga para programador PHP/Laravel.',
            'location' => 'Braga',
            'salary' => 1200,
            'contract_type' => 'full-time',
            'expiration_date' => now()->addMonth(),
        ]);

        Job::create([
            'company_id' => 1,
            'title' => 'Designer Gráfico',
            'category_id' => 2,
            'description' => 'Vaga para designer gráfico com experiência em UI/UX.',
            'location' => 'Barcelos',
            'salary' => 1000,
            'contract_type' => 'part-time',
            'expiration_date' => now()->addMonth(),
        ]);
    }
}
