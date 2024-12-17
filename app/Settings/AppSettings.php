<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class AppSettings extends Settings
{
    public ?string $logo = '';
    public string $facebook;
    public string $twitter;
    public string $instagram;
    public string $youtube;
    public string $tiktok;

    public static function group(): string
    {
        return 'general';
    }
}
