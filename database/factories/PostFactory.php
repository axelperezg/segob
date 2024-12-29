<?php

namespace Database\Factories;

use App\Enums\MexicanStateEnum;
use App\Enums\Posts\ContentTypeEnum;
use App\Models\Audio;
use App\Models\Document;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'content' => fake()->paragraph(),
            'excerpt' => fake()->sentences(2, true),
            'bulletin' => fake()->randomElement(['A', 'B', 'C']),
            'year' => fake()->year(),
            'slug' => fake()->slug(),
            'is_published' => fake()->boolean(),
            'content_type' => collect(ContentTypeEnum::cases())->random(),
            'state' => collect(MexicanStateEnum::cases())->random(),
            'published_at' => fake()->dateTimeBetween('-2 weeks', 'now'),
            'created_by' => User::factory(),
            'keywords' => fake()->words(3, true),
            'audio_id' => Audio::factory(),
            'document_id' => Document::factory(),
        ];
    }

    public function withImage()
    {
        return $this->afterCreating(function (Post $post) {
            $post
                ->addMediaFromUrl('https://picsum.photos/1600/900')
                ->toMediaCollection('image');
        });
    }
}
