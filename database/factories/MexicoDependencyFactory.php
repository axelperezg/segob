<?php

namespace Database\Factories;

use App\Models\MexicoDependency;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MexicoDependency>
 */
class MexicoDependencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = MexicoDependency::class;
    
    public function definition(): array
    {
        return [
            'name' => fake()->company() . ' México',
        ];
    }
}
