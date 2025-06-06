<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VideoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'url' => $this->faker->url(),
            'slug' => fn ($data) => Str::slug($data['title']),
            'is_published' => true,
            'published_at' => $this->faker->dateTimeBetween('-7 days', 'now'),
        ];
    }
}
