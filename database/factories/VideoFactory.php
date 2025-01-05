<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'url' => $this->faker->url(),
            'is_published' => true,
            'published_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
