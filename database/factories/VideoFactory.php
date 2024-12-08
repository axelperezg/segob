<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'is_published' => true,
            'published_at' => now(),
            'title' => fake()->sentence(),
            'url' => fake()->url(),
        ];
    }
}
