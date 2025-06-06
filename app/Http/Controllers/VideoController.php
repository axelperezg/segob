<?php

namespace App\Http\Controllers;

use App\Http\Resources\VideoResource;
use App\Models\Video;
use Inertia\Inertia;

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

        return Inertia::render('Videos/Index', [
            'videos' => VideoResource::collection($videos),
            'filters' => $filters,
        ]);
    }

    public function show(Video $video)
    {
        $video->load('posts');

        return Inertia::render('Videos/Show', [
            'video' => VideoResource::make($video),
        ]);
    }
}
