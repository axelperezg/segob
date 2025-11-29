<?php

namespace App\Providers;

use App\Helpers\ViewHelper;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share data with all Blade views
        View::composer('*', function ($view) {
            // Only share data if not in admin panel (Filament)
            if (! request()->is('admin*')) {
                $view->with('mainMenu', ViewHelper::getMainMenu());
                $view->with('appSettings', ViewHelper::getAppSettings());
            }
        });
    }
}
