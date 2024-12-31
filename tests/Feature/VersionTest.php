<?php

namespace Tests\Feature;

use App\Enums\Posts\ContentTypeEnum;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VersionTest extends TestCase
{
    use RefreshDatabase;

    public function test_version_page_can_be_rendered(): void
    {
        // Create a stenographic version post
        Post::factory()->create([
            'content_type' => ContentTypeEnum::STENOGRAPHIC_VERSION,
        ]);

        // Create a different type of post (shouldn't appear in response)
        Post::factory()->create([
            'content_type' => ContentTypeEnum::BULLETIN,
        ]);

        $response = $this->get('/versiones');

        $response->assertStatus(200)
            ->assertInertia(fn ($page) => $page
                ->component('Version')
                ->has('posts')
                ->has('filters')
            );
    }
}
