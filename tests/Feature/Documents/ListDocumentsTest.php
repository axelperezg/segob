<?php

namespace Tests\Feature\Documents;

use App\Filament\Resources\DocumentResource;
use App\Filament\Resources\DocumentResource\Pages\ListDocuments;
use App\Models\Document;
use App\Models\DocumentSection;
use Livewire\Livewire;
use Tests\TestCase;

class ListDocumentsTest extends TestCase
{
    public function test_can_render_page()
    {
        $response = $this->get(DocumentResource::getUrl('index'));

        $response->assertOk();
    }

    public function test_can_list_documents()
    {
        // Arrange
        $documentSection = DocumentSection::factory()->create();
        $documents = Document::factory()->count(3)->create([
            'document_section_id' => $documentSection->id,
        ]);

        $component = Livewire::test(ListDocuments::class);

        // Assert
        foreach ($documents as $document) {
            $component->assertSee($document->name);
        }
    }

    public function test_can_sort_documents_by_name()
    {
        // Arrange
        $documentSection = DocumentSection::factory()->create();
        Document::factory()->create([
            'name' => 'Z Document',
            'document_section_id' => $documentSection->id,
        ]);
        Document::factory()->create([
            'name' => 'A Document',
            'document_section_id' => $documentSection->id,
        ]);
        Document::factory()->create([
            'name' => 'M Document',
            'document_section_id' => $documentSection->id,
        ]);

        // Act & Assert
        Livewire::test(ListDocuments::class)
            ->assertCanSeeTableRecords([
                ['name' => 'A Document'],
                ['name' => 'M Document'],
                ['name' => 'Z Document'],
            ], inOrder: false)
            ->sortTable('name')
            ->assertCanSeeTableRecords([
                ['name' => 'A Document'],
                ['name' => 'M Document'],
                ['name' => 'Z Document'],
            ], inOrder: true);
    }

    public function test_can_search_documents()
    {
        // Arrange
        $documentSection = DocumentSection::factory()->create();
        Document::factory()->create([
            'name' => 'Test Document 1',
            'document_section_id' => $documentSection->id,
        ]);
        Document::factory()->create([
            'name' => 'Another Document',
            'document_section_id' => $documentSection->id,
        ]);

        // Act & Assert
        Livewire::test(ListDocuments::class)
            ->searchTable('Test')
            ->assertCanSeeTableRecords([
                ['name' => 'Test Document 1'],
            ])
            ->assertCanNotSeeTableRecords([
                ['name' => 'Another Document'],
            ]);
    }

    public function test_can_filter_by_document_section()
    {
        // Arrange
        $section1 = DocumentSection::factory()->create(['name' => 'Section 1']);
        $section2 = DocumentSection::factory()->create(['name' => 'Section 2']);
        
        Document::factory()->create([
            'name' => 'Document 1',
            'document_section_id' => $section1->id,
        ]);
        Document::factory()->create([
            'name' => 'Document 2',
            'document_section_id' => $section2->id,
        ]);

        // Act & Assert
        Livewire::test(ListDocuments::class)
            ->filterTable('document_section_id', $section1->id)
            ->assertCanSeeTableRecords([
                ['name' => 'Document 1'],
            ])
            ->assertCanNotSeeTableRecords([
                ['name' => 'Document 2'],
            ]);
    }
} 