<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Cria ou atualiza o usuário para evitar duplicatas
        User::updateOrCreate(
            ['email' => 'test@example.com'], // Critério de busca
            [
                'name' => 'Test User',
                'password' => bcrypt('password'), // Senha padrão para testes
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
