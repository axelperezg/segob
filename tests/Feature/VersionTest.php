<?php

namespace Tests\Feature;

use App\Enums\Posts\ContentTypeEnum;
use App\Models\Dependency;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VersionTest extends TestCase
{
    public function test_version_page_can_be_rendered(): void
    {
        // Arrange
        $dependency = Dependency::factory()->create();
        $anotherDependency = Dependency::factory()->create();
        $post = Post::factory()->hasAttached($dependency)->create([
            'content_type' => ContentTypeEnum::STENOGRAPHIC_VERSION,
        ]);
        Post::factory()->hasAttached($anotherDependency)->create([
            'content_type' => ContentTypeEnum::STENOGRAPHIC_VERSION,
        ]);

        $uri = route('versions.index', ['dependency_id' => $dependency->id]);

        // Act  
        $response = $this->get($uri);

        // Assert
        $response->assertStatus(200)
            ->assertInertia(fn ($page) => $page
                ->component('Version')
                ->has('posts.data', 1)
                ->has('filters')

                ->where('posts.data.0.id', $post->id)
            );
    }
}
