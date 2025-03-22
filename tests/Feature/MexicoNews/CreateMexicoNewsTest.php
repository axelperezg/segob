<?php

namespace Tests\Feature\MexicoNews;

use App\Filament\Resources\MexicoNewsResource;
use App\Filament\Resources\MexicoNewsResource\Pages\CreateMexicoNews;
use App\Models\Dependency;
use App\Models\MexicoNews;
use Illuminate\Http\UploadedFile;
use Livewire\Livewire;
use Tests\TestCase;

class CreateMexicoNewsTest extends TestCase
{
    public function test_can_render_page()
    {
        $response = $this->get(MexicoNewsResource::getUrl('create'));

        $response->assertOk();
    }

    public function test_can_create_mexico_news()
    {
        // Arrange
        $dependency = Dependency::factory()->create();
        $data = MexicoNews::factory()->make([
            'dependency_id' => $dependency->id
        ]);
        
        $component = Livewire::test(CreateMexicoNews::class);

        // Act
        $component->fillForm([
            'title' => $data->title,
            'url' => $data->url,
            'published_at' => $data->published_at,
            'dependency_id' => $data->dependency_id,
            'is_published' => true,
            'image' => UploadedFile::fake()->image('news.jpg'),
        ])->call('create');

        // Assert
        $component->assertHasNoErrors();

        $this->assertCount(1, MexicoNews::all());

        $news = MexicoNews::first();
        $this->assertEquals($data->title, $news->title);
        $this->assertEquals($data->url, $news->url);
        $this->assertEquals($data->dependency_id, $news->dependency_id);
        $this->assertNotNull($news->getFirstMedia('image'));
    }

    public function test_fields_are_required()
    {
        // Arrange
        $component = Livewire::test(CreateMexicoNews::class);

        // Act
        $component->fillForm([
            'title' => null,
            'url' => null,
            'published_at' => null,
        ])->call('create');

        // Assert
        $component->assertHasFormErrors([
            'title' => 'required',
            'url' => 'required',
            'published_at' => 'required',
        ]);
    }

    public function test_url_must_be_valid()
    {
        // Arrange
        $component = Livewire::test(CreateMexicoNews::class);

        // Act
        $component->fillForm([
            'title' => 'Test News',
            'url' => 'invalid-url',
            'published_at' => now(),
        ])->call('create');

        // Assert
        $component->assertHasFormErrors([
            'url' => 'url',
        ]);
    }
} 