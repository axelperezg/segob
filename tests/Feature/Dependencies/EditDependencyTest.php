<?php

namespace Tests\Feature\Dependencies;

use App\Filament\Resources\DependencyResource;
use App\Filament\Resources\DependencyResource\Pages\CreateDependency;
use App\Filament\Resources\DependencyResource\Pages\EditDependency;
use App\Models\Dependency;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Livewire\Livewire;
use Tests\TestCase;

class EditDependencyTest extends TestCase
{
    private Dependency $dependency;
    
    public function setUp(): void
    {
        parent::setUp();

        $this->dependency = Dependency::factory()->create();
        $this->actingAs(User::factory()->create());
    }

    public function test_it_can_render_page()
    {
        $response = $this->get(DependencyResource::getUrl('edit', ['record' => $this->dependency]));

        $response->assertOk();
    }

    public function test_it_can_update_dependency()
    {
        // Arrange
        $data = Dependency::factory()->make();
        $component = Livewire::test(EditDependency::class, ['record' => $this->dependency->id]);

        // Act
        $component->fillForm([
            'name' => $data->name,
            'image' => UploadedFile::fake()->image('test.jpg'),
            'banner' => UploadedFile::fake()->image('banner.jpg'),
        ])->call('save');

        // Assert
        $component
            ->assertHasNoErrors()
            ->assertRedirect(DependencyResource::getUrl('index'));

        $this->assertCount(1, Dependency::all());
        $dependency = Dependency::first();
        $this->assertEquals($data->name, $dependency->name);
        $this->assertNotNull($dependency->getFirstMedia('image')->getFullUrl());
        $this->assertNotNull($dependency->getFirstMedia('banner')->getFullUrl());
    }

    public function test_fields_are_required()
    {
        // Arrange
        $component = Livewire::test(CreateDependency::class);

        // Act
        $component->fillForm([
            'name' => null,
            'image' => null,
            'banner' => null,
        ])->call('create');

        // Assert
        $component->assertHasFormErrors([
            'name' => 'required',
        ]);
        $component->assertHasNoErrors([
            'image' => 'nullable',
            'banner' => 'nullable',
        ]);
    }
}

