<?php

namespace Database\Seeders;

use App\Models\AreaOfInterest;
use Illuminate\Database\Seeder;

class AreaOfInterestSeeder extends Seeder
{
    public function run()
    {
        AreaOfInterest::create(['name' => 'Technology']);
        AreaOfInterest::create(['name' => 'Healthcare']);
        AreaOfInterest::create(['name' => 'Education']);
    }
}
