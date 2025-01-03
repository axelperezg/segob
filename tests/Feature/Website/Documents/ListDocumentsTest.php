<?php

namespace Tests\Feature\Website\Documents;

use App\Enums\Documents\DocumentSectionEnum;
use App\Models\Document;
use Tests\TestCase;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListDocumentsTest extends TestCase
{
    private function documentList($data = [])
    {
        $uri = route('documents.index', $data);

        return $this->get($uri);
    }

    public function test_it_can_render_page(): void
    {
        // Arrange
        Document::factory(10)->create();

        // Act
        $response = $this->documentList();

        // Assert
        $response->assertStatus(200);
        $response->assertInertia(fn ($assert) => $assert
            ->component('Documents/Index')
            ->has('documents.data', 10)
        );
    }

    public function test_it_can_filter_by_name(): void
    {
        // Arrange
        $documents = Document::factory(10)->create();
        $document = $documents->first();

        // Act
        $response = $this->documentList(['name' => $document->name]);

        // Assert
        $response->assertStatus(200);
        $response->assertInertia(fn ($assert) => $assert
            ->has('documents.data', 1)
            ->where('documents.data.0.id', $document->id)
        );
    }

    public function test_it_can_filter_by_document_section(): void
    {
        // Arrange
        foreach (DocumentSectionEnum::cases() as $documentSection) {
            Document::factory()->create(['document_section' => $documentSection]);
        }

        $document = Document::all()->random();
    
        // Act
        $response = $this->documentList(['document_section' => $document->document_section->value]);

        // Assert
        $response->assertStatus(200);
        $response->assertInertia(fn ($assert) => $assert
            ->has('documents.data', 1)
            ->where('documents.data.0.id', $document->id)
        );
    }
} 
