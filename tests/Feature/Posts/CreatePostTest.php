<?php

use App\Filament\Resources\PostResource;
use App\Filament\Resources\PostResource\Pages\CreatePost;
use App\Models\Post;
use Livewire\Livewire;

use function Pest\Laravel\get;
use function PHPUnit\Framework\assertCount;

beforeEach(function () {
    $this->component = Livewire::test(CreatePost::class);
});

it('can render create post page', function () {
    get(PostResource::getUrl('create'))->assertSuccessful();
});

it('can create a post', function () {
    // Arrange
    $data = Post::factory()->make();;

    // Act
    $this->component->fillForm([
        'is_published' => true,
        'title' => $data->title,
        'content' => $data->content,
        'content_type' => $data->content_type,
        'keywords' => $data->keywords,
        'state' => $data->state,
        'published_at' => $data->published_at,
        'created_by' => $data->created_by,
    ])->call('create');

    // Assert
    assertCount(1, Post::all());
    $post = Post::first();
    expect($post)
        ->is_published->toBeTrue()
        ->title->toBe($data->title)
        ->content->toBe($data->content)
        ->keywords->toBe($data->keywords)
        ->content_type->toBe($data->content_type)
        ->state->toBe($data->state)
        ->published_at->format('Y-m-d H:i')->toBe($data->published_at->format('Y-m-d H:i'))
        ->created_by->toBe($data->created_by);
});
