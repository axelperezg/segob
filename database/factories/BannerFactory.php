<?php

namespace Database\Factories;

use App\Models\Banner;
use Illuminate\Database\Eloquent\Factories\Factory;

class BannerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'external_url' => fake()->url(),
        ];
    }

    public function withImage(): self
    {
        return $this->afterCreating(function (Banner $banner) {
            $banner->addMediaFromUrl('https://picsum.photos/1200/300')
                ->toMediaCollection('banner');
        });
    }
}
