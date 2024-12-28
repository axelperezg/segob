<?php

namespace Database\Factories;

use App\Models\Video;
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

    public function withImage()
    {
        return $this->afterCreating(function (Video $video) {
            $video->addMediaFromUrl('https://picsum.photos/600/400')->toMediaCollection('image');
        });
    }
}
