<?php

namespace Tests\Feature\MexicoDependencies;

use App\Filament\Resources\MexicoDependencyResource;
use App\Filament\Resources\MexicoDependencyResource\Pages\EditMexicoDependency;
use App\Models\MexicoDependency;
use Livewire\Livewire;
use Tests\TestCase;

class EditMexicoDependencyTest extends TestCase
{
    public MexicoDependency $dependency;

    protected function setUp(): void
    {
        parent::setUp();

        $this->dependency = MexicoDependency::factory()->create();
    }

    public function test_can_render_page()
    {
        $response = $this->get(MexicoDependencyResource::getUrl('edit', [
            'record' => $this->dependency,
        ]));

        $response->assertOk();
    }

    public function test_can_update_mexico_dependency()
    {
        // Arrange
        $data = MexicoDependency::factory()->make();
        $component = Livewire::test(EditMexicoDependency::class, [
            'record' => $this->dependency->id,
        ]);

        // Act
        $component->fillForm([
            'name' => $data->name,
        ])->call('save');

        // Assert
        $component->assertHasNoErrors();

        $this->assertCount(1, MexicoDependency::all());

        $dependency = MexicoDependency::first();
        $this->assertEquals($data->name, $dependency->name);
    }

    public function test_fields_are_required()
    {
        // Arrange
        $component = Livewire::test(EditMexicoDependency::class, [
            'record' => $this->dependency->id,
        ]);

        // Act
        $component->fillForm([
            'name' => null,
        ])->call('save');

        // Assert
        $component->assertHasFormErrors([
            'name' => 'required',
        ]);
    }

    public function test_name_max_length()
    {
        // Arrange
        $component = Livewire::test(EditMexicoDependency::class, [
            'record' => $this->dependency->id,
        ]);
        $longString = str_repeat('a', 256); // 256 caracteres

        // Act
        $component->fillForm([
            'name' => $longString,
        ])->call('save');

        // Assert
        $component->assertHasFormErrors([
            'name' => 'max',
        ]);
    }
} 