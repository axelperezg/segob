<?php

namespace Database\Seeders;

use App\Models\Document;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void {
        Post::query()->delete();
        Document::query()->delete();
        // Post::factory()->count(5)->create(['is_published' => true]);
    }
}
