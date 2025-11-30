<?php

namespace App\Http\Controllers;

use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::query()
            ->filterByPublishedAt(request('published_at'))
            ->searchByTitle(request('title'))
            ->orderByDesc('published_at')
            ->paginate()
            ->withQueryString();

        $filters = [
            'title' => request('title'),
            'published_at' => request('published_at'),
        ];

        return view('pages.videos.index', [
            'videos' => $videos,
            'filters' => $filters,
        ]);
    }

    public function show(Video $video)
    {
        $video->load('posts');

        return view('pages.videos.show', [
            'video' => $video,
        ]);
    }
}
