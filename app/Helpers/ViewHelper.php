<?php

namespace App\Helpers;

use App\Models\Action;
use App\Settings\AppSettings;

class ViewHelper
{
    /**
     * Get the main menu structure
     */
    public static function getMainMenu(): array
    {
        return [
            [
                'name' => 'INICIO',
                'url' => '/',
            ],
            [
                'name' => 'NOTICIAS',
                'url' => route('news.index'),
            ],
            [
                'name' => 'VERSIONES',
                'url' => route('versions.index'),
            ],
            [
                'name' => 'DOCUMENTOS',
                'url' => route('documents.index'),
                'submenu' => [
                    [
                        'name' => 'Infografías',
                        'url' => route('infographics.index'),
                    ],
                ],
            ],
            [
                'name' => 'SEGOB',
                'url' => route('segob-news.index'),
            ],
            [
                'name' => 'GALERÍAS',
                'url' => route('photo-galleries.index'),
            ],
            [
                'name' => 'VIDEO',
                'url' => route('videos.index'),
            ],
            [
                'name' => 'NOTICIAS MÉXICO',
                'url' => route('mexico-news.index'),
            ],
            [
                'name' => 'ACCIONES',
                'url' => '#',
                'submenu' => Action::all()->map(fn ($action) => [
                    'name' => $action->name,
                    'url' => route('actions.show', $action->slug),
                ])->toArray(),
            ],
        ];
    }

    /**
     * Get app settings
     */
    public static function getAppSettings(): array
    {
        $settings = app(AppSettings::class);

        return [
            'logo' => $settings->logo,
            'social_networks' => $settings->social_networks,
            'map_url' => $settings->map_url,
            'contact_content' => $settings->contact_content,
            'mexico_logo' => $settings->mexico_logo,
            'footer_links' => $settings->footer_links,
            'top_bar_links' => $settings->top_bar_links,
            'meta_title' => $settings->meta_title,
            'meta_description' => $settings->meta_description,
        ];
    }

    /**
     * Get all shared data for Blade views
     */
    public static function getSharedData(): array
    {
        return [
            'mainMenu' => self::getMainMenu(),
            'appSettings' => self::getAppSettings(),
        ];
    }
}
