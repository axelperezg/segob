<?php

use Illuminate\Support\Facades\Storage;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $logo = asset('assets/segob-noticias.png');
        Storage::disk('public')->put('logo.png', file_get_contents($logo));
        
        $this->migrator->add('general.logo', 'logo.png');
        $this->migrator->add('general.social_networks', [
            [
                'network' => 'facebook',
                'url' => 'https://www.facebook.com/',
            ],
            [
                'network' => 'twitter', 
                'url' => 'https://www.twitter.com/',
            ],
            [
                'network' => 'instagram',
                'url' => 'https://www.instagram.com/',
            ],
            [
                'network' => 'youtube',
                'url' => 'https://www.youtube.com/',
            ],
            [
                'network' => 'tiktok',
                'url' => 'https://www.tiktok.com/',
            ]
        ]);
        $this->migrator->add('general.map_url', 'https://www.google.com/maps');
        $this->migrator->add('general.contact_content', 'Contenido de contacto');
    }

    public function down(): void
    {
        $this->migrator->delete('general.logo');
        $this->migrator->delete('general.social_networks');
    }
};
