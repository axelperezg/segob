<?php

namespace Tests\Feature\Documents;

use App\Enums\Documents\DocumentTypeEnum;
use App\Filament\Resources\DocumentResource;
use App\Filament\Resources\DocumentResource\Pages\CreateDocument;
use App\Models\Document;
use App\Models\DocumentSection;
use Illuminate\Http\UploadedFile;
use Livewire\Livewire;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Tests\TestCase;

class CreateDocumentTest extends TestCase
{
    public function test_can_render_page()
    {
        $response = $this->get(DocumentResource::getUrl('create'));

        $response->assertOk();
    }

    public function test_can_create_document()
    {
        // Arrange
        $data = Document::factory()->make([
            'type' => DocumentTypeEnum::PRESENTATION,
        ]);

        $component = Livewire::test(CreateDocument::class);

        // Act
        $component->fillForm([
            'name' => $data->name,
            'is_published' => true,
            'published_at' => $data->published_at,
            'type' => $data->type->value,
            'document_section_id' => $data->document_section_id,
            'image' => UploadedFile::fake()->image('image.jpg'),
            'document' => UploadedFile::fake()->create('document.pdf', 1024, 'application/pdf'),
        ])->call('create');

        // Assert
        $component->assertHasNoErrors();
        
        $this->assertCount(1, Document::all());

        $document = Document::first();
        $this->assertEquals($data->name, $document->name);
        $this->assertEquals($data->type, $document->type);
        $this->assertEquals($data->document_section_id, $document->document_section_id);
        $this->assertTrue($document->is_published);
        $this->assertEquals($data->published_at->format('Y-m-d'), $document->published_at->format('Y-m-d'));
        $this->assertNotNull($document->image);
        $this->assertNotNull($document->getFirstMedia('document')->getFullUrl());
    }

    public function test_fields_are_required()
    {
        // Arrange
        $component = Livewire::test(CreateDocument::class);

        // Act
        $component->fillForm([
            'name' => null,
        ])->call('create');

        // Assert
        $component->assertHasFormErrors([
            'name'
        ]);
        $component->assertHasNoErrors([
            'name',
            'type',
            'document_section_id',
            'published_at',
        ]);
    }
} 