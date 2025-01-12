<?php

namespace Tests\Feature\Website;

use App\Enums\Posts\ContentTypeEnum;
use App\Models\Post;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class NewsTest extends TestCase
{
    private function getNewsPage(array $data = [])
    {
        $uri = route('news.index', $data);

        return $this->get($uri);
    }

    public function test_news_page_loads_successfully(): void
    {
        // Act
        $response = $this->getNewsPage();

        // Assert
        $response
            ->assertStatus(200)
            ->assertInertia(fn (AssertableInertia $page) => $page
                ->component('News/Index')
                ->has('filters')
                ->has('posts')
            );
    }

    public function test_it_can_search_post_by_title(): void
    {
        // Arrange
        $posts = Post::factory(10)->create();

        $post = $posts->first();

        // Act
        $response = $this->getNewsPage([
            'title' => $post->title,
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
            ->create(['content_type' => ContentTypeEnum::BULLETIN]);

        Post::factory(5)
            ->create(['content_type' => ContentTypeEnum::JOINT_STATEMENT]);

        // Act
        $response = $this->getNewsPage([
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

        Post::factory()->create(['published_at' => now()->subDay()]);
        $post = Post::factory()->create(['published_at' => today()]);

        // Act
        $response = $this->getNewsPage([
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
