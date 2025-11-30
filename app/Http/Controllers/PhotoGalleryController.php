<?php

namespace App\Http\Controllers;

use App\Models\PhotoGallery;

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

        return view('pages.photo-galleries.index', [
            'galleries' => $galleries,
            'filters' => $filters,
        ]);
    }

    public function show(PhotoGallery $photoGallery)
    {
        $photoGallery->load('posts');

        return view('pages.photo-galleries.show', [
            'photoGallery' => $photoGallery,
        ]);
    }
}
