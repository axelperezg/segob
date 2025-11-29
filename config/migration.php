<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Use Blade Routes
    |--------------------------------------------------------------------------
    |
    | When true, routes will use Blade views instead of Inertia.js
    |
    */

    'use_blade' => env('USE_BLADE_ROUTES', false),

    /*
    |--------------------------------------------------------------------------
    | Dual Mode
    |--------------------------------------------------------------------------
    |
    | When true, allows both Blade and Inertia.js to coexist during migration.
    |
    */

    'dual_mode' => env('DUAL_MODE', true),

    /*
    |--------------------------------------------------------------------------
    | Migrated Routes
    |--------------------------------------------------------------------------
    |
    | List of route names that have been migrated to Blade.
    | Format: ['route.name' => true, ...]
    |
    */

    'migrated_routes' => [
        // Example: 'videos.show' => true,
    ],

];
