<?php

namespace Tests\Feature\Banners;

use App\Filament\Resources\BannerResource;
use App\Filament\Resources\BannerResource\Pages\CreateBanner;
use App\Models\Banner;
use Illuminate\Http\UploadedFile;
use Livewire\Livewire;
use Tests\TestCase;

class CreateBannerTest extends TestCase
{
    public function test_can_render_page()
    {
        $response = $this->get(BannerResource::getUrl('create'));

        $response->assertOk();
    }

    public function test_can_create_banner()
    {
        // Arrange
        $data = Banner::factory()->make();
        $component = Livewire::test(CreateBanner::class);

        // Act
        $component->fillForm([
            'title' => $data->title,
            'external_url' => $data->external_url,
            'banner' => UploadedFile::fake()->image('banner.jpg'),
        ])->call('create');

        // Assert
        $component->assertHasNoErrors();

        $this->assertCount(1, Banner::all());

        $banner = Banner::first();
        $this->assertEquals($data->title, $banner->title);
        $this->assertEquals($data->external_url, $banner->external_url);
        $this->assertNotNull($banner->getFirstMedia('banner')->getFullUrl());
    }

    public function test_fields_are_required()
    {
        // Arrange
        $component = Livewire::test(CreateBanner::class);

        // Act
        $component->fillForm([
            'title' => null,
            'external_url' => null,
            'banner' => null,
        ])->call('create');

        // Assert
        $component->assertHasFormErrors([
            'title' => 'required',
            'external_url' => 'required',
            'banner' => 'required',
        ]);
    }

    public function test_external_url_must_be_valid()
    {
        // Arrange
        $component = Livewire::test(CreateBanner::class);

        // Act
        $component->fillForm([
            'title' => 'Test Banner',
            'external_url' => 'invalid-url',
            'banner' => UploadedFile::fake()->image('banner.jpg'),
        ])->call('create');

        // Assert
        $component->assertHasFormErrors([
            'external_url' => 'url',
        ]);
    }
}
