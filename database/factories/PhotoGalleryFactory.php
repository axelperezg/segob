<?php

namespace Database\Factories;

use App\Models\PhotoGallery;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PhotoGallery>
 */
class PhotoGalleryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'slug' => fn ($data) => Str::slug($data['name']),
            'is_published' => true,
            'published_at' => fake()->dateTimeBetween('-7 days', 'now'),
        ];
    }

    public function withImage()
    {
        return $this->afterCreating(function (PhotoGallery $photoGallery) {
            $photoGallery->addMediaFromUrl('https://picsum.photos/600/400')->toMediaCollection('image');
        });
    }
}
