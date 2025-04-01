<?php

namespace Database\Factories;

use App\Models\MexicoDependency;
use App\Models\MexicoNews;
use Illuminate\Database\Eloquent\Factories\Factory;

class MexicoNewsFactory extends Factory
{
    protected $model = MexicoNews::class;

    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'url' => fake()->url(),
            'image' => null,
            'published_at' => fake()->dateTimeBetween('-1 month', 'now'),
            'mexico_dependency_id' => MexicoDependency::factory(),
        ];
    }
}
