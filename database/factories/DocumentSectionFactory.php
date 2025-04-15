<?php

namespace Database\Factories;

use App\Models\Document;
use App\Models\DocumentSection;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentSectionFactory extends Factory
{
    protected $model = DocumentSection::class;

    public function definition(): array
    {
        $i = $this->faker->numberBetween(1, 999);
        
        return [
            'name' => "Section {$i}",
        ];
    }
}
