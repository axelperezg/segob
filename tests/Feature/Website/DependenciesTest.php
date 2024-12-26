<?php

namespace Tests\Feature\Website;

use App\Enums\Posts\ContentTypeEnum;
use App\Models\Dependency;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class DependenciesTest extends TestCase
{
    public Dependency $dependency;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
        $this->dependency = Dependency::factory()->create();
    }

    private function getDependencyPage(array $data = [])
    {
        $uri = route('dependencies.show', array_merge(['dependency' => $this->dependency->slug], $data));

        return $this->get($uri);
    }

    public function test_dependencies_page_loads_successfully(): void
    {
        // Act
        $response = $this->getDependencyPage();

        // Assert
        $response
            ->assertStatus(200)
            ->assertInertia(fn (AssertableInertia $page) => $page
                ->component('Dependencies/Show')
                ->has('dependency')
                ->has('filters')
                ->has('posts')
            );
    }

    public function test_it_can_search_post_by_title(): void
    {
        // Arrange
        $posts = Post::factory(10)
            ->hasAttached($this->dependency)
            ->create();

        $post = $posts->first();

        // Act
        $response = $this->getDependencyPage([
            'filter' => [
                'title' => $post->title,
            ],
        ]);

        // Assert
        $response
            ->assertInertia(fn (AssertableInertia $page) => $page
                ->has('posts.data', 1)
                ->where('posts.data.0.id', $post->id)
            );
    }

    public function test_it_can_filter_by_content_type(): void
    {
        // Arrange
        Post::factory(5)
            ->hasAttached($this->dependency)
            ->create(['content_type' => ContentTypeEnum::BULLETIN]);

        Post::factory(5)
            ->hasAttached($this->dependency)
            ->create(['content_type' => ContentTypeEnum::JOINT_STATEMENT]);

        // Act
        $response = $this->getDependencyPage([
            'content_type' => [ContentTypeEnum::BULLETIN->value],
        ]);

        // Assert
        $response
            ->assertInertia(fn (AssertableInertia $page) => $page
                ->has('posts.data', 5)
                ->where('posts.data.0.content_type', ContentTypeEnum::BULLETIN->getLabel())
                ->where('posts.data.1.content_type', ContentTypeEnum::BULLETIN->getLabel())
                ->where('posts.data.2.content_type', ContentTypeEnum::BULLETIN->getLabel())
                ->where('posts.data.3.content_type', ContentTypeEnum::BULLETIN->getLabel())
                ->where('posts.data.4.content_type', ContentTypeEnum::BULLETIN->getLabel())
            );
    }

    public function test_it_can_filter_by_date(): void
    {
        // Arrange
        $this->withoutExceptionHandling();

        Post::factory()->hasAttached($this->dependency)->create(['published_at' => now()->subDay()]);
        $post = Post::factory()->hasAttached($this->dependency)->create(['published_at' => today()]);

        // Act
        $response = $this->getDependencyPage([
            'published_at' => today()->format('Y-m-d'),
        ]);

        // Assert
        $response
            ->assertInertia(fn (AssertableInertia $page) => $page
                ->has('posts.data', 1)
                ->where('posts.data.0.id', $post->id)
            );
    }
}
