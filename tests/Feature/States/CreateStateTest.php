<?php

namespace Tests\Feature\States;

use App\Filament\Resources\StateResource;
use App\Filament\Resources\StateResource\Pages\CreateState;
use App\Models\State;
use Livewire\Livewire;
use Tests\TestCase;

class CreateStateTest extends TestCase
{
    public function test_can_render_page()
    {
        $response = $this->get(StateResource::getUrl('create'));

        $response->assertOk();
    }

    public function test_can_create_state()
    {
        // Arrange
        $data = State::factory()->make();
        $component = Livewire::test(CreateState::class);

        // Act
        $component->fillForm([
            'name' => $data->name,
        ])->call('create');

        // Assert
        $component->assertHasNoErrors();

        $this->assertCount(1, State::all());

        $state = State::first();
        $this->assertEquals($data->name, $state->name);
    }

    public function test_fields_are_required()
    {
        // Arrange
        $component = Livewire::test(CreateState::class);

        // Act
        $component->fillForm([
            'name' => null,
        ])->call('create');

        // Assert
        $component->assertHasFormErrors([
            'name' => 'required',
        ]);
    }
}
