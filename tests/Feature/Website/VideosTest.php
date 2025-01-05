<?php

namespace Tests\Feature\Website;

use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VideosTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_shows_published_videos(): void
    {
        $publishedVideo = Video::factory()->create([
            'is_published' => true,
            'published_at' => now(),
        ]);

        $unpublishedVideo = Video::factory()->create([
            'is_published' => false,
            'published_at' => now(),
        ]);

        $response = $this->get(route('videos.index'));

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page
            ->component('Videos/Index')
            ->has('videos.data', 1)
            ->where('videos.data.0.id', $publishedVideo->id)
            ->where('videos.data.0.title', $publishedVideo->title)
        );
    }
}
