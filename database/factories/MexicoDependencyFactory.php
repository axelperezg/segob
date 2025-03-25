<?php

namespace Database\Factories;

use App\Models\MexicoDependency;
use Illuminate\Database\Eloquent\Factories\Factory;

class MexicoDependencyFactory extends Factory
{
    protected $model = MexicoDependency::class;

    public function definition(): array
    {
        return [
            'name' => fake()->company().' México',
        ];
    }
}
