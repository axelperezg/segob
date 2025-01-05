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
}
