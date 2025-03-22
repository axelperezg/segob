<?php

namespace Tests\Feature\MexicoNews;

use App\Filament\Resources\MexicoNewsResource;
use App\Filament\Resources\MexicoNewsResource\Pages\EditMexicoNews;
use App\Models\Dependency;
use App\Models\MexicoNews;
use Illuminate\Http\UploadedFile;
use Livewire\Livewire;
use Tests\TestCase;

class EditMexicoNewsTest extends TestCase
{
    public MexicoNews $news;
    
    protected function setUp(): void
    {
        parent::setUp();

        $dependency = Dependency::factory()->create();
        $this->news = MexicoNews::factory()->create([
            'dependency_id' => $dependency->id
        ]);
    }

    public function test_can_render_page()
    {
        $response = $this->get(MexicoNewsResource::getUrl('edit', [
            'record' => $this->news,
        ]));

        $response->assertOk();
    }

    public function test_can_update_mexico_news()
    {
        // Arrange
        $newDependency = Dependency::factory()->create();
        $newData = MexicoNews::factory()->make([
            'dependency_id' => $newDependency->id
        ]);
        
        $component = Livewire::test(EditMexicoNews::class, [
            'record' => $this->news->id,
        ]);

        // Act
        $component->fillForm([
            'title' => $newData->title,
            'url' => $newData->url,
            'published_at' => $newData->published_at,
            'dependency_id' => $newData->dependency_id,
            'is_published' => true,
            'image' => UploadedFile::fake()->image('news.jpg'),
        ])->call('save');

        // Assert
        $component->assertHasNoErrors();

        $this->news->refresh();
        $this->assertEquals($newData->title, $this->news->title);
        $this->assertEquals($newData->url, $this->news->url);
        $this->assertEquals($newData->dependency_id, $this->news->dependency_id);
    }

    public function test_fields_are_required()
    {
        // Arrange
        $component = Livewire::test(EditMexicoNews::class, [
            'record' => $this->news->id,
        ]);

        // Act
        $component->fillForm([
            'title' => null,
            'url' => null,
            'published_at' => null,
        ])->call('save');

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
        $component = Livewire::test(EditMexicoNews::class, [
            'record' => $this->news->id,
        ]);

        // Act
        $component->fillForm([
            'title' => 'Test News',
            'url' => 'invalid-url',
            'published_at' => now(),
        ])->call('save');

        // Assert
        $component->assertHasFormErrors([
            'url' => 'url',
        ]);
    }
} 