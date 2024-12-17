<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.logo', 'logo.png');
        $this->migrator->add('general.facebook', 'https://www.facebook.com/');
        $this->migrator->add('general.twitter', 'https://www.twitter.com/');
        $this->migrator->add('general.instagram', 'https://www.instagram.com/');
        $this->migrator->add('general.youtube', 'https://www.youtube.com/');
        $this->migrator->add('general.tiktok', 'https://www.tiktok.com/');
    }

    public function down(): void
    {
        $this->migrator->delete('general.logo');
        $this->migrator->delete('general.facebook');
        $this->migrator->delete('general.twitter');
        $this->migrator->delete('general.instagram');
        $this->migrator->delete('general.youtube');
        $this->migrator->delete('general.tiktok');
    }
};
