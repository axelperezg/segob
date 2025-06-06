<?php

namespace Tests\Feature\MexicoDependencies;

use App\Filament\Resources\MexicoDependencyResource;
use App\Filament\Resources\MexicoDependencyResource\Pages\ListMexicoDependencies;
use App\Models\MexicoDependency;
use Livewire\Livewire;
use Tests\TestCase;

class ListMexicoDependenciesTest extends TestCase
{
    public function test_can_render_page()
    {
        $response = $this->get(MexicoDependencyResource::getUrl('index'));

        $response->assertOk();
    }

    public function test_can_list_mexico_dependencies()
    {
        // Arrange
        $dependencies = MexicoDependency::factory()->count(3)->create();
        $component = Livewire::test(ListMexicoDependencies::class);

        // Assert
        foreach ($dependencies as $dependency) {
            $component->assertSee($dependency->name);
        }
    }

    public function test_can_sort_mexico_dependencies_by_name()
    {
        // Arrange
        MexicoDependency::factory()->create(['name' => 'Zacatecas Gov']);
        MexicoDependency::factory()->create(['name' => 'Aguascalientes Gov']);
        MexicoDependency::factory()->create(['name' => 'Michoacán Gov']);

        // Act & Assert
        Livewire::test(ListMexicoDependencies::class)
            ->assertCanSeeTableRecords([
                ['name' => 'Aguascalientes Gov'],
                ['name' => 'Michoacán Gov'],
                ['name' => 'Zacatecas Gov'],
            ], inOrder: false)
            ->sortTable('name')
            ->assertCanSeeTableRecords([
                ['name' => 'Aguascalientes Gov'],
                ['name' => 'Michoacán Gov'],
                ['name' => 'Zacatecas Gov'],
            ], inOrder: true);
    }

    public function test_can_search_mexico_dependencies()
    {
        // Arrange
        MexicoDependency::factory()->create(['name' => 'Gobierno Central']);
        MexicoDependency::factory()->create(['name' => 'Ministerio de Educación']);
        MexicoDependency::factory()->create(['name' => 'Secretaría de Educación']);

        // Act & Assert
        Livewire::test(ListMexicoDependencies::class)
            ->searchTable('Educación')
            ->assertCanSeeTableRecords([
                ['name' => 'Ministerio de Educación'],
                ['name' => 'Secretaría de Educación'],
            ])
            ->assertCanNotSeeTableRecords([
                ['name' => 'Gobierno Central'],
            ]);
    }
}
