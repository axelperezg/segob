<?php

namespace Tests\Feature\MexicoNews;

use App\Filament\Resources\MexicoNewsResource;
use App\Filament\Resources\MexicoNewsResource\Pages\CreateMexicoNews;
use App\Models\MexicoDependency;
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
        $mexicoDependency = MexicoDependency::factory()->create();
        $data = MexicoNews::factory()->make([
            'mexico_dependency_id' => $mexicoDependency->id,
        ]);

        $component = Livewire::test(CreateMexicoNews::class);

        // Act
        $component->fillForm([
            'title' => $data->title,
            'url' => $data->url,
            'published_at' => $data->published_at,
            'mexico_dependency_id' => $data->mexico_dependency_id,
            'image' => UploadedFile::fake()->image('news.jpg'),
            'documents' => [
                UploadedFile::fake()->create('documento.pdf', 1024, 'application/pdf'),
            ],
        ])->call('create');

        // Assert
        $component->assertHasNoErrors();

        $this->assertCount(1, MexicoNews::all());

        $news = MexicoNews::first();
        $this->assertEquals($data->title, $news->title);
        $this->assertEquals($data->url, $news->url);
        $this->assertEquals($data->mexico_dependency_id, $news->mexico_dependency_id);
        $this->assertNotNull($news->getFirstMedia('image'));
        $this->assertNotNull($news->getFirstMedia('documents'));
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

    public function test_pdf_url_must_be_valid_if_provided()
    {
        // Arrange
        $component = Livewire::test(CreateMexicoNews::class);

        // Act
        $component->fillForm([
            'title' => 'Test News',
            'url' => 'https://example.com',
            'pdf_url' => 'invalid-url',
            'published_at' => now(),
        ])->call('create');

        // Assert
        $component->assertHasFormErrors([
            'pdf_url' => 'url',
        ]);
    }
}
