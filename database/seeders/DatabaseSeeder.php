<?php

namespace Database\Seeders;

use App\Models\PhotoGallery;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void {

        PhotoGallery::query()->delete();

        PhotoGallery::factory(30)->create();
    }
}
