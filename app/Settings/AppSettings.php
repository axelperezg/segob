<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class AppSettings extends Settings
{
    public ?string $logo = '';

    public array $social_networks = [];

    public ?string $map_url = '';

    public ?string $contact_content = '';

    public static function group(): string
    {
        return 'general';
    }
}
