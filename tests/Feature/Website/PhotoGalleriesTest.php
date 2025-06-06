<?php

namespace Tests\Feature\Website;

use App\Models\PhotoGallery;
use Tests\TestCase;

class PhotoGalleriesTest extends TestCase
{
    public function test_can_render_the_gallery_show_page()
    {
        $gallery = PhotoGallery::factory()->create();

        $response = $this->get(route('photo-galleries.show', $gallery));

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page
            ->component('PhotoGalleries/Show')
            ->has('gallery')
        );
    }
}
