<?php

namespace Tests\Feature\Website\Documents;

use App\Models\Document;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class ShowDocumentTest extends TestCase
{
    public function test_it_can_render_the_document_show_page()
    {
        $document = Document::factory()->create();

        $response = $this->get(route('documents.show', $document));

        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('Documents/Show')
            ->has('document')
        );
    }
}
