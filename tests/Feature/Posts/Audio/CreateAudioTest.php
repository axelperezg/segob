<?php

use App\Filament\Resources\AudioResource;
use App\Filament\Resources\AudioResource\Pages\CreateAudio;
use App\Models\Audio;
use App\Models\Post;
use Illuminate\Http\UploadedFile;
use Livewire\Livewire;

use function Pest\Laravel\get;
use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;

beforeEach(function () {
    $this->component = Livewire::test(CreateAudio::class);
});

it('can render create audio page', function () {
    get(AudioResource::getUrl('create'))->assertSuccessful();
});

it('can create an audio', function () {
    // Arrange
    $data = Audio::factory()->make();
    $post = Post::factory()->create(['audio_id' => null]);

    // Act
    $component = $this->component->fillForm([
        'title' => $data->title,
        'is_published' => false,
        'published_at' => today()->subDay()->format('Y-m-d'),
        'posts' => [$post->id],
        'audio' => UploadedFile::fake()->create('audio.mp3'),
    ])->call('create');

    // Assert
    $component->assertHasNoErrors();

    assertCount(1, Audio::all());
    $audio = Audio::first();
    expect($audio)
        ->title->toBe($data->title)
        ->is_published->toBeFalse()
        ->published_at->format('Y-m-d')->toBe(today()->subDay()->format('Y-m-d'));

    assertNotNull($audio->getFirstMedia('audio')->getFullUrl());

    assertCount(1, $audio->posts);
    assertEquals($post->id, $audio->posts->first()->id);
});
