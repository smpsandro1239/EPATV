<?php

namespace Database\Seeders;

use App\Models\AreaOfInterest;
use Illuminate\Database\Seeder;

class AreaOfInterestSeeder extends Seeder
{
    public function run()
    {
        $areas = [
            'Animação Sociocultural',
            'Cabeleireiro',
            'Comércio e Vendas',
            'Cozinha / Pastelaria',
            'Design Gráfico',
            'Desporto',
            'Eletrotecnia',
            'Estética',
            'Fiél de Armazém',
            'Gerontologia',
            'Instalações Elétricas',
            'Limpeza',
            'Mecatrónica Automóvel',
            'Multimédia',
            'Ótica Ocular',
            'Padaria / Pastelaria',
            'Programação Informática',
            'Receção / Assistente Administrativo',
            'Refrigeração e Climatização',
            'Restaurante / Bar',
        ];

        foreach ($areas as $area) {
            AreaOfInterest::create(['name' => $area]);
        }
    }
}
