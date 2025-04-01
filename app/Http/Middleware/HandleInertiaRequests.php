<?php

namespace App\Http\Middleware;

use App\Models\Action;
use App\Settings\AppSettings;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;

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
            'ziggy' => fn () => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
            'main_menu' => [
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
                    'submenu' => Action::all()->map(function ($action) {
                        return [
                            'name' => $action->name,
                            'url' => route('actions.show', $action->slug),
                        ];
                    })->toArray(),
                ],
            ],
            'app_settings' => [
                'logo' => app(AppSettings::class)->logo,
                'social_networks' => app(AppSettings::class)->social_networks,
                'map_url' => app(AppSettings::class)->map_url,
                'contact_content' => app(AppSettings::class)->contact_content,
                'mexico_logo' => app(AppSettings::class)->mexico_logo,
                'footer_links' => app(AppSettings::class)->footer_links,
            ],
        ]);
    }
}
