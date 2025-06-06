<?php

namespace Tests\Feature\Website;

use App\Models\Video;
use Tests\TestCase;

class ListVideosTest extends TestCase
{
    private function listVideos($data = [])
    {
        $uri = route('videos.index', $data);

        return $this->get($uri);
    }

    public function test_it_can_render_page(): void
    {
        // Arrange
        Video::factory(10)->create();

        // Act
        $response = $this->listVideos();

        // Assert
        $response
            ->assertStatus(200)
            ->assertInertia(fn ($page) => $page
                ->component('Videos/Index')
                ->has('videos.data', 10)
            );
    }

    public function test_it_can_search_by_title(): void
    {
        // Arrange
        Video::factory(10)->create();
        $video = Video::factory()->create([
            'title' => 'Test Video',
        ]);

        // Act
        $response = $this->listVideos([
            'title' => $video->title,
        ]);

        // Assert
        $response
            ->assertInertia(fn ($page) => $page
                ->has('videos.data', 1)
                ->where('videos.data.0.id', $video->id)
            );
    }

    public function test_it_can_search_by_published_at(): void
    {
        // Arrange
        Video::factory(10)->create(['published_at' => now()->subDays(2)]);
        $video = Video::factory()->create([
            'published_at' => now(),
        ]);

        // Act
        $response = $this->listVideos([
            'published_at' => now()->format('Y-m-d'),
        ]);

        // Assert
        $response
            ->assertInertia(fn ($page) => $page
                ->has('videos.data', 1)
                ->where('videos.data.0.id', $video->id)
            );
    }
}
