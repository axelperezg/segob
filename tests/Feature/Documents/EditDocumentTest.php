<?php

namespace Tests\Feature\Documents;

use App\Enums\Documents\DocumentTypeEnum;
use App\Filament\Resources\DocumentResource;
use App\Filament\Resources\DocumentResource\Pages\EditDocument;
use App\Models\Document;
use App\Models\DocumentSection;
use Illuminate\Http\UploadedFile;
use Livewire\Livewire;
use Tests\TestCase;

class EditDocumentTest extends TestCase
{
    public Document $document;

    protected function setUp(): void
    {
        parent::setUp();

        $documentSection = DocumentSection::factory()->create();
        $this->document = Document::factory()->create([
            'document_section_id' => $documentSection->id,
        ]);
    }

    public function test_can_render_page()
    {
        $response = $this->get(DocumentResource::getUrl('edit', [
            'record' => $this->document,
        ]));

        $response->assertOk();
    }

    public function test_can_update_document()
    {
        // Arrange
        $newDocumentSection = DocumentSection::factory()->create();
        $newData = Document::factory()->make([
            'document_section_id' => $newDocumentSection->id,
        ]);

        $component = Livewire::test(EditDocument::class, [
            'record' => $this->document->id,
        ]);

        // Act
        $component->fillForm([
            'name' => $newData->name,
            'is_published' => false,
            'published_at' => $newData->published_at,
            'type' => $newData->type,
            'document_section_id' => $newData->document_section_id,
            'image' => UploadedFile::fake()->image('new-image.jpg'),
            'document' => UploadedFile::fake()->create('new-document.pdf', 1024, 'application/pdf'),
        ])->call('save');

        // Assert
        $component->assertHasNoErrors();

        $this->document->refresh();
        $this->assertEquals($newData->name, $this->document->name);
        $this->assertEquals($newData->type, $this->document->type);
        $this->assertEquals($newData->document_section_id, $this->document->document_section_id);
        $this->assertFalse($this->document->is_published);
        $this->assertEquals($newData->published_at->format('Y-m-d'), $this->document->published_at->format('Y-m-d'));
        $this->assertNotNull($this->document->getFirstMedia('image')->getFullUrl());
        $this->assertNotNull($this->document->getFirstMedia('document')->getFullUrl());
    }

    public function test_fields_are_required()
    {
        // Arrange
        $component = Livewire::test(EditDocument::class, [
            'record' => $this->document->id,
        ]);

        // Act
        $component->fillForm([
            'name' => null,
            'type' => null,
            'document_section_id' => null,
            'published_at' => null,
        ])->call('save');

        // Assert
        $component->assertHasFormErrors([
            'name' => 'required',
            'type' => 'required',
            'document_section_id' => 'required',
            'published_at' => 'required',
        ]);
    }

    public function test_document_must_be_pdf()
    {
        // Arrange
        $newDocumentSection = DocumentSection::factory()->create();
        $component = Livewire::test(EditDocument::class, [
            'record' => $this->document->id,
        ]);

        // Act
        $component->fillForm([
            'name' => 'Updated Document',
            'is_published' => true,
            'published_at' => now(),
            'type' => DocumentTypeEnum::PDF->value,
            'document_section_id' => $newDocumentSection->id,
            'image' => UploadedFile::fake()->image('new-image.jpg'),
            'document' => UploadedFile::fake()->create('document.txt', 1024, 'text/plain'),
        ])->call('save');

        // Assert
        $component->assertHasFormErrors([
            'document' => 'accepted_file_types',
        ]);
    }
} 