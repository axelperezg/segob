<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AudioFactory extends Factory
{
    public function definition(): array
    {
        return [
            'is_published' => true,
            'published_at' => now(),
            'title' => $this->faker->sentence(),
        ];
    }
}
