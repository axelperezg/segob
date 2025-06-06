<?php

use App\Enums\Posts\ContentTypeEnum;
use App\Filament\Resources\PostResource;
use App\Filament\Resources\PostResource\Pages\CreatePost;
use App\Models\Action;
use App\Models\Audio;
use App\Models\Dependency;
use App\Models\Document;
use App\Models\Post;
use App\Models\State;
use App\Models\Video;
use Illuminate\Http\UploadedFile;
use Livewire\Livewire;

use function Pest\Laravel\get;
use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;

beforeEach(function () {
    $this->component = Livewire::test(CreatePost::class);
});

it('can render create post page', function () {
    get(PostResource::getUrl('create'))->assertSuccessful();
});

it('can create a post', function () {
    // Arrange
    $data = Post::factory()->make(['content_type' => ContentTypeEnum::JOINT_STATEMENT->value]);
    $action = Action::factory()->create();
    $dependency = Dependency::factory()->create();
    $audio = Audio::factory()->create();
    $document = Document::factory()->create();
    $video = Video::factory()->create();
    $states = State::factory(2)->create()->pluck('id')->toArray();
    $stenographicVersion = Post::factory()->create(['content_type' => ContentTypeEnum::STENOGRAPHIC_VERSION]);

    // Act
    $this->component->fillForm([
        'is_published' => true,
        'title' => $data->title,
        'content' => $data->content,
        'excerpt' => $data->excerpt,
        'content_type' => $data->content_type,
        'keywords' => $data->keywords,
        'states' => $states,
        'published_at' => $data->published_at,
        'created_by' => $data->created_by,
        'actions' => [$action->id],
        'dependencies' => [$dependency->id],
        'image' => $image = UploadedFile::fake()->image('image.jpg'),
        'document' => UploadedFile::fake()->create('document.pdf'),
        'audio_id' => $audio->id,
        'document_id' => $document->id,
        'video_id' => $video->id,
        'stenographic_version_id' => $stenographicVersion->id,
    ])->call('create');

    // Assert
    assertCount(1, Post::where('title', $data->title)->get());
    $post = Post::query()->firstWhere('title', $data->title);
    expect($post)
        ->is_published->toBeTrue()
        ->title->toBe($data->title)
        ->content->toBe($data->content)
        ->excerpt->toBe($data->excerpt)
        ->keywords->toBe($data->keywords)
        ->content_type->toBe($data->content_type)
        ->published_at->format('Y-m-d H:i')->toBe($data->published_at->format('Y-m-d H:i'))
        ->created_by->toBe($data->created_by)
        ->image->not->toBeNull()
        ->bulletin->toBeNull()
        ->year->toBeNull();

    assertCount(2, $post->states);
    expect($post->states->pluck('id')->toArray())->toEqualCanonicalizing($states);

    assertCount(1, $post->actions);
    expect($post->actions->first())->id->toBe($action->id);

    assertCount(1, $post->dependencies);
    expect($post->dependencies->first())->id->toBe($dependency->id);

    assertNotNull($post->audio_id);
    assertEquals($audio->id, $post->audio_id);

    assertNotNull($post->document_id);
    assertEquals($document->id, $post->document_id);

    assertNotNull($post->video_id);
    assertEquals($video->id, $post->video_id);

    assertNotNull($post->stenographic_version_id);
    assertEquals($stenographicVersion->id, $post->stenographic_version_id);
});

it('can create a bulletin post', function () {
    // Arrange
    $data = Post::factory()->make(['content_type' => ContentTypeEnum::COMMUNIQUE->value]);
    $action = Action::factory()->create();
    $dependency = Dependency::factory()->create();
    $audio = Audio::factory()->create();
    $document = Document::factory()->create();
    $video = Video::factory()->create();
    $states = State::factory(2)->create()->pluck('id')->toArray();

    // Act
    $this->component->fillForm([
        'is_published' => true,
        'title' => $data->title,
        'content' => $data->content,
        'excerpt' => $data->excerpt,
        'content_type' => $data->content_type->value,
        'bulletin' => $data->bulletin,
        'year' => $data->year,
        'keywords' => $data->keywords,
        'states' => $states,
        'published_at' => $data->published_at,
        'created_by' => $data->created_by,
        'actions' => [$action->id],
        'dependencies' => [$dependency->id],
        'image' => UploadedFile::fake()->image('image.jpg'),
        'document' => UploadedFile::fake()->create('document.pdf'),
        'audio_id' => $audio->id,
        'document_id' => $document->id,
        'video_id' => $video->id,
    ])->call('create');

    // Assert
    $post = Post::first();
    expect($post)
        ->bulletin->toBe($data->bulletin)
        ->year->toBe($data->year);
});

it('can create a communique post', function () {
    // Arrange
    $data = Post::factory()->make(['content_type' => ContentTypeEnum::COMMUNIQUE->value]);
    $action = Action::factory()->create();
    $dependency = Dependency::factory()->create();
    $audio = Audio::factory()->create();
    $document = Document::factory()->create();
    $video = Video::factory()->create();
    $states = State::factory(2)->create()->pluck('id')->toArray();

    // Act
    $this->component->fillForm([
        'is_published' => true,
        'title' => $data->title,
        'content' => $data->content,
        'excerpt' => $data->excerpt,
        'content_type' => $data->content_type->value,
        'bulletin' => $data->bulletin,
        'year' => $data->year,
        'keywords' => $data->keywords,
        'states' => $states,
        'published_at' => $data->published_at,
        'created_by' => $data->created_by,
        'actions' => [$action->id],
        'dependencies' => [$dependency->id],
        'image' => UploadedFile::fake()->image('image.jpg'),
        'document' => UploadedFile::fake()->create('document.pdf'),
        'audio_id' => $audio->id,
        'document_id' => $document->id,
        'video_id' => $video->id,
    ])->call('create');

    // Assert
    $post = Post::first();
    expect($post)
        ->bulletin->toBe($data->bulletin)
        ->year->toBe($data->year);
});
