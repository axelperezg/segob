<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'content' => fake()->paragraph(),
            'slug' => fake()->slug(),
            'is_published' => fake()->boolean(),
            'content_type' => fake()->randomElement(['text', 'image', 'video']),
            'state' => fake()->randomElement(['Jalisco', 'Nuevo León', 'Yucatán', 'Chiapas', 'Oaxaca', 'Veracruz']),
            'published_at' => fake()->dateTime(),
            'created_by' => User::factory(),
        ];
    }
}
