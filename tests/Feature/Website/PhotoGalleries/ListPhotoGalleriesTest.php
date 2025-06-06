<?php

namespace Tests\Feature\Website\PhotoGalleries;

use App\Models\PhotoGallery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListPhotoGalleriesTest extends TestCase
{
    use RefreshDatabase;

    private function listPhotoGalleries($data = [])
    {
        $uri = route('photo-galleries.index', $data);

        return $this->get($uri);
    }

    public function test_it_can_list_photo_galleries()
    {
        // Arrange
        PhotoGallery::factory(10)->create();

        // Act
        $response = $this->listPhotoGalleries();

        // Assert
        $response
            ->assertStatus(200)
            ->assertInertia(fn ($assert) => $assert
                ->component('PhotoGalleries/Index')
                ->has('galleries.data', 10)
            );
    }

    public function test_it_can_filter_photo_galleries_by_name()
    {
        // Arrange
        PhotoGallery::factory(10)->create();
        $photoGallery = PhotoGallery::factory()->create();

        // Act
        $response = $this->listPhotoGalleries(['title' => $photoGallery->name]);

        // Assert
        $response
            ->assertInertia(fn ($assert) => $assert
                ->has('galleries.data', 1)
                ->where('galleries.data.0.id', $photoGallery->id)
            );
    }

    public function test_it_can_filter_photo_galleries_by_published_at()
    {
        // Arrange
        $photoGallery = PhotoGallery::factory()->create(['published_at' => now()]);
        PhotoGallery::factory(9)->create(['published_at' => now()->subDay()]);

        // Act
        $response = $this->listPhotoGalleries([
            'published_at' => now()->format('Y-m-d'),
        ]);

        // Assert
        $response
            ->assertInertia(fn ($assert) => $assert
                ->has('galleries.data', 1)
                ->where('galleries.data.0.id', $photoGallery->id)
            );
    }
}
