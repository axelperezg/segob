<?php

namespace Tests\Feature\States;

use App\Filament\Resources\StateResource;
use App\Filament\Resources\StateResource\Pages\EditState;
use App\Models\State;
use Livewire\Livewire;
use Tests\TestCase;

class EditStateTest extends TestCase
{
    public State $state;

    protected function setUp(): void
    {
        parent::setUp();

        $this->state = State::factory()->create();
    }

    public function test_can_render_page()
    {
        $response = $this->get(StateResource::getUrl('edit', [
            'record' => $this->state,
        ]));

        $response->assertOk();
    }

    public function test_can_update_state()
    {
        // Arrange
        $data = State::factory()->make();
        $component = Livewire::test(EditState::class, [
            'record' => $this->state->id,
        ]);

        // Act
        $component->fillForm([
            'name' => $data->name,
        ])->call('save');

        // Assert
        $component->assertHasNoErrors();

        $this->assertCount(1, State::all());

        $state = State::first();
        $this->assertEquals($data->name, $state->name);
    }

    public function test_fields_are_required()
    {
        // Arrange
        $component = Livewire::test(EditState::class, [
            'record' => $this->state->id,
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
} 