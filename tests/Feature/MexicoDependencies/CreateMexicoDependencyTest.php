<?php

namespace Tests\Feature\MexicoDependencies;

use App\Filament\Resources\MexicoDependencyResource;
use App\Filament\Resources\MexicoDependencyResource\Pages\CreateMexicoDependency;
use App\Models\MexicoDependency;
use Livewire\Livewire;
use Tests\TestCase;

class CreateMexicoDependencyTest extends TestCase
{
    public function test_can_render_page()
    {
        $response = $this->get(MexicoDependencyResource::getUrl('create'));

        $response->assertOk();
    }

    public function test_can_create_mexico_dependency()
    {
        // Arrange
        $data = MexicoDependency::factory()->make();
        $component = Livewire::test(CreateMexicoDependency::class);

        // Act
        $component->fillForm([
            'name' => $data->name,
        ])->call('create');

        // Assert
        $component->assertHasNoErrors();

        $this->assertCount(1, MexicoDependency::all());

        $dependency = MexicoDependency::first();
        $this->assertEquals($data->name, $dependency->name);
    }

    public function test_fields_are_required()
    {
        // Arrange
        $component = Livewire::test(CreateMexicoDependency::class);

        // Act
        $component->fillForm([
            'name' => null,
        ])->call('create');

        // Assert
        $component->assertHasFormErrors([
            'name' => 'required',
        ]);
    }

    public function test_name_max_length()
    {
        // Arrange
        $component = Livewire::test(CreateMexicoDependency::class);
        $longString = str_repeat('a', 256); // 256 caracteres

        // Act
        $component->fillForm([
            'name' => $longString,
        ])->call('create');

        // Assert
        $component->assertHasFormErrors([
            'name' => 'max',
        ]);
    }
}
