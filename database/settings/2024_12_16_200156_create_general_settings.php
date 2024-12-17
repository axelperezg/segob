<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.logo', 'logo.png');
        $this->migrator->add('general.social_networks', []);
    }

    public function down(): void
    {
        $this->migrator->delete('general.logo');
        $this->migrator->delete('general.social_networks');
    }
};
