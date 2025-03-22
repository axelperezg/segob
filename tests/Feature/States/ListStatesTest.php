<?php

namespace Tests\Feature\States;

use App\Filament\Resources\StateResource;
use App\Filament\Resources\StateResource\Pages\ListStates;
use App\Models\State;
use Livewire\Livewire;
use Tests\TestCase;

class ListStatesTest extends TestCase
{
    public function test_it_can_render_page()
    {
        $this->get(StateResource::getUrl('index'))
            ->assertSuccessful();
    }

    public function test_it_can_see_state_list()
    {
        // Arrange
        $states = State::factory()->count(10)->create();

        // Act
        $component = Livewire::test(ListStates::class);

        // Assert
        $component
            ->assertCanRenderTableColumn('name')
            ->assertCanSeeTableRecords($states);
    }
}