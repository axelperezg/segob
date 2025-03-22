<?php

namespace Tests\Feature\MexicoNews;

use App\Filament\Resources\MexicoNewsResource;
use App\Filament\Resources\MexicoNewsResource\Pages\EditMexicoNews;
use App\Models\MexicoDependency;
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

        $mexicoDependency = MexicoDependency::factory()->create();
        $this->news = MexicoNews::factory()->create([
            'mexico_dependency_id' => $mexicoDependency->id
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
        $newMexicoDependency = MexicoDependency::factory()->create();
        $newData = MexicoNews::factory()->make([
            'mexico_dependency_id' => $newMexicoDependency->id
        ]);
        
        $component = Livewire::test(EditMexicoNews::class, [
            'record' => $this->news->id,
        ]);

        // Act
        $component->fillForm([
            'title' => $newData->title,
            'url' => $newData->url,
            'pdf_url' => 'https://example.com/documento.pdf',
            'published_at' => $newData->published_at,
            'mexico_dependency_id' => $newData->mexico_dependency_id,
            'image' => UploadedFile::fake()->image('news.jpg'),
        ])->call('save');

        // Assert
        $component->assertHasNoErrors();

        $this->news->refresh();
        $this->assertEquals($newData->title, $this->news->title);
        $this->assertEquals($newData->url, $this->news->url);
        $this->assertEquals('https://example.com/documento.pdf', $this->news->pdf_url);
        $this->assertEquals($newData->mexico_dependency_id, $this->news->mexico_dependency_id);
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

    public function test_pdf_url_must_be_valid_if_provided()
    {
        // Arrange
        $component = Livewire::test(EditMexicoNews::class, [
            'record' => $this->news->id,
        ]);

        // Act
        $component->fillForm([
            'title' => 'Test News',
            'url' => 'https://example.com',
            'pdf_url' => 'invalid-url',
            'published_at' => now(),
        ])->call('save');

        // Assert
        $component->assertHasFormErrors([
            'pdf_url' => 'url',
        ]);
    }
} 