<?php

namespace Database\Factories;

use App\Models\MexicoDependency;
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
            'pdf_url' => fake()->boolean(70) ? fake()->url() . '.pdf' : null,
            'published_at' => fake()->dateTimeBetween('-1 month', 'now'),
            'mexico_dependency_id' => MexicoDependency::factory(),
        ];
    }
}
