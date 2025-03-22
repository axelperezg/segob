<?php

namespace Database\Factories;

use App\Models\Dependency;
use App\Models\MexicoNews;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MexicoNews>
 */
class MexicoNewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = MexicoNews::class;
    
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'url' => fake()->url(),
            'published_at' => fake()->dateTimeBetween('-1 month', 'now'),
            'dependency_id' => Dependency::factory(),
            'is_published' => true,
        ];
    }
}
