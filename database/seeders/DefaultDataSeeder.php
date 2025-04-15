<?php

namespace Database\Seeders;

use App\Models\Dependency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultDataSeeder extends Seeder
{
    /**
     * Seed default data for the application.
     */
    public function run(): void
    {
        Dependency::create([
            'name' => 'Segob',
            'slug' => 'segob',
        ]);
    }
}
