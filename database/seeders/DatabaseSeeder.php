<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Video;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        dd(Post::find(1)->refresh()->getFirstMediaUrl('image'));
        Video::query()->delete();
        Video::factory(40)->create();
    }
}
