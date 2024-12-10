<?php

use App\Filament\Resources\ActionResource;
use App\Filament\Resources\ActionResource\Pages\CreateAction;
use App\Models\Action;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Livewire\Livewire;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function PHPUnit\Framework\assertCount;

beforeEach(function () {
    $this->component = Livewire::test(CreateAction::class);
});

it('can render the create action page', function () {
    get(ActionResource::getUrl('create'))->assertOk();
});

it('can create an action', function () {
    // Arrange
    $data = Action::factory()->make();
    $component = Livewire::test(CreateAction::class);

    // Act
    $component->fillForm([
        'name' => $data->name,
        'banner' => UploadedFile::fake()->image('image.jpg'),
    ])->call('create');

    // Assert
    $component->assertHasNoErrors();

    assertCount(1, Action::all());
    $action = Action::first();
    expect($action)
        ->name->toBe($data->name)
        ->slug->toBe(Str::slug($data->name));

    expect($action->getFirstMedia('banner')->getFullUrl())->not->toBeNull();
});
