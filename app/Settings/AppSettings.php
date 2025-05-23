<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class AppSettings extends Settings
{
    public ?string $logo = '';

    public ?string $mexico_logo = '';

    public array $social_networks = [];

    public ?string $map_url = '';

    public ?string $contact_content = '';

    public array $footer_links = [];

    public array $top_bar_links = [];
    
    public ?string $meta_title = '';
    
    public ?string $meta_description = '';
    
    public static function group(): string
    {
        return 'general';
    }
}
