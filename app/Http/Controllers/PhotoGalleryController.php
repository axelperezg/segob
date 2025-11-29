<?php

namespace App\Http\Controllers;

use App\Http\Resources\PhotoGalleryResource;
use App\Models\PhotoGallery;
use Inertia\Inertia;

class PhotoGalleryController extends Controller
{
    public function index()
    {
        $galleries = PhotoGallery::query()
            ->filterByPublishedAt(request('published_at'))
            ->searchByName(request('title'))
            ->orderByDesc('published_at')
            ->paginate()
            ->withQueryString();

        $filters = [
            'title' => request('title'),
            'published_at' => request('published_at'),
        ];

        return Inertia::render('PhotoGalleries/Index', [
            'galleries' => PhotoGalleryResource::collection($galleries),
            'filters' => $filters,
        ]);
    }

    public function show(PhotoGallery $photoGallery)
    {
        $photoGallery->load('posts');

        // Check if we should use Blade
        if (config('migration.use_blade') || in_array('photo-galleries.show', config('migration.migrated_routes', []))) {
            return view('pages.photo-galleries.show', [
                'photoGallery' => $photoGallery,
            ]);
        }

        return Inertia::render('PhotoGalleries/Show', [
            'gallery' => PhotoGalleryResource::make($photoGallery),
        ]);
    }
}
