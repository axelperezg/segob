<?php

namespace Database\Factories;

use App\Enums\Documents\DocumentSectionEnum;
use App\Enums\Documents\DocumentTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'is_published' => fake()->boolean(),
            'published_at' => fake()->date(),
            'name' => fake()->name(),
            'type' => fake()->randomElement(DocumentTypeEnum::cases()),
            'document_section' => fake()->randomElement(DocumentSectionEnum::cases()),
        ];
    }
}
