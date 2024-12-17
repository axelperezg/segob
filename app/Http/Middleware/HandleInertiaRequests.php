<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use App\Models\Action;
use App\Settings\AppSettings;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'main_menu' => [
                [
                    'name' => 'INICIO',
                    'url' => '/',
                ],
                [
                    'name' => 'NOTICIAS',
                    'url' => '/',
                ],
                [
                    'name' => 'VERSIONES',
                    'url' => '#',
                ],
                [
                    'name' => 'DOCUMENTOS',
                    'url' => '#',
                ],
                [
                    'name' => 'SEGOB',
                    'url' => '#',
                ],
                [
                    'name' => 'GALERÍAS',
                    'url' => '#',
                ],
                [
                    'name' => 'VIDEO',
                    'url' => '#',
                ],
                [
                    'name' => 'NOTICIAS MÉXICO',
                    'url' => '#',
                ],
                [
                    'name' => 'ACCIONES',
                    'url' => '#',
                    'submenu' => Action::all()->map(function($action) {
                        return [
                            'name' => $action->name,
                            'url' => route('actions.show', $action->slug)
                        ];
                    })->toArray()
                ],
            ],
            'app_settings' => [
                'logo' => app(AppSettings::class)->logo,
                'facebook' => app(AppSettings::class)->facebook,
                'twitter' => app(AppSettings::class)->twitter,
                'instagram' => app(AppSettings::class)->instagram,
                'youtube' => app(AppSettings::class)->youtube,
                'tiktok' => app(AppSettings::class)->tiktok,
            ]
        ]);
    }
}
