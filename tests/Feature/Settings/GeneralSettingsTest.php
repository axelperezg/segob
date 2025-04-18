<?php

namespace Tests\Feature\Settings;

use App\Filament\Pages\GeneralSettings;
use App\Settings\AppSettings;
use Illuminate\Http\UploadedFile;
use Livewire\Livewire;
use Tests\TestCase;

class GeneralSettingsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $component = Livewire::test(GeneralSettings::class);
        $component->fillForm(['social_networks' => []])->call('save');
    }

    public function test_settings_page_loads_successfully(): void
    {
        // Act
        $response = $this->get(GeneralSettings::getUrl());

        // Assert
        $response->assertSuccessful();
    }

    public function test_can_update_settings(): void
    {
        // Arrange
        $component = Livewire::test(GeneralSettings::class);
        $settings = app(AppSettings::class);

        // Act
        $component->fillForm([
            'logo' => UploadedFile::fake()->image('logo.jpg'),
            'mexico_logo' => UploadedFile::fake()->image('mexico-logo.jpg'),
            'social_networks' => [
                [
                    'network' => 'facebook',
                    'url' => 'https://facebook.com/test',
                ],
                [
                    'network' => 'twitter',
                    'url' => 'https://twitter.com/test',
                ],
            ],
            'map_url' => 'https://www.google.com/maps',
            'contact_content' => 'Contenido de contacto',
            'footer_links' => [
                [
                    'title' => 'Título 1',
                    'url' => 'https://www.google.com/maps',
                ],
            ],
            'top_bar_links' => [
                [
                    'name' => 'Noticias',
                    'url' => 'https://www.google.com/maps',
                    'external' => false,
                ],
            ],
        ])->call('save');

        // Assert
        $component->assertHasNoErrors();

        $settings = app(AppSettings::class);
        $this->assertNotNull($settings->logo);
        $this->assertNotNull($settings->mexico_logo);
        $this->assertCount(2, $settings->social_networks);
        $this->assertEquals('facebook', $settings->social_networks[0]['network']);
        $this->assertEquals('https://facebook.com/test', $settings->social_networks[0]['url']);
        $this->assertEquals('twitter', $settings->social_networks[1]['network']);
        $this->assertEquals('https://twitter.com/test', $settings->social_networks[1]['url']);
        $this->assertEquals('https://www.google.com/maps', $settings->map_url);
        $this->assertEquals('Contenido de contacto', $settings->contact_content);
        $this->assertCount(1, $settings->top_bar_links);
        $this->assertEquals('Noticias', $settings->top_bar_links[0]['name']);
        $this->assertEquals('https://www.google.com/maps', $settings->top_bar_links[0]['url']);
        $this->assertEquals(false, $settings->top_bar_links[0]['external']);
    }

    public function test_social_network_url_must_be_valid(): void
    {
        // Arrange
        $component = Livewire::test(GeneralSettings::class);

        // Act
        $component->fillForm([
            'social_networks' => [
                [
                    'network' => 'facebook',
                    'url' => 'invalid-url',
                ],
            ],
        ])->call('save');

        // Assert
        $component->assertHasFormErrors([
            'social_networks.0.url' => 'url',
        ]);
    }
}
