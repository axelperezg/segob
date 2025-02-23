<?php

namespace Database\Factories;

use App\Enums\Posts\ContentTypeEnum;
use App\Models\Audio;
use App\Models\Document;
use App\Models\Post;
use App\Models\State;
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
            'published_at' => fake()->dateTimeBetween('-2 weeks', 'now'),
            'created_by' => User::factory(),
            'keywords' => fake()->words(3, true),
            'audio_id' => Audio::factory(),
            'document_id' => Document::factory(),
            'stenographic_version_id' => null,
            'last_edited_by' => null,
            'last_edited_at' => null,
            'image' => null,
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Post $post) {
            $states = State::inRandomOrder()->limit(rand(1, 3))->get();
            $post->states()->attach($states);
        });
    }
}
