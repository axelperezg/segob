<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use RalphJSmit\Laravel\SEO\Models\SEO;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /** @var Post $post */
        $post = Post::query()->find(62);
        dd($post->seo);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'axelperezg@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
