<?php

namespace Database\Seeders;

use App\Models\Dependency;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultDataSeeder extends Seeder
{
    /**
     * Seed default data for the application.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Axel Pérez',
            'email' => 'axelperezg@gmail.com',
        ]);

        Dependency::create([
            'name' => 'Segob',
            'slug' => 'segob',
        ]);
    }
}
