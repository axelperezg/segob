<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Video::query()->delete();
        Video::factory(40)->create();
    }
}
