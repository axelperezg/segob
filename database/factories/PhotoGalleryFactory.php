<?php

namespace Database\Factories;

use App\Models\PhotoGallery;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PhotoGallery>
 */
class PhotoGalleryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'is_published' => true,
            'published_at' => now(),
        ];
    }

    public function withImage()
    {
        return $this->afterCreating(function (PhotoGallery $photoGallery) {
            $photoGallery->addMediaFromUrl('https://picsum.photos/600/400')->toMediaCollection('image');
        });
    }
}
