<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Inertia\Inertia;

class NewsController extends Controller
{
    public function __invoke()
    {
        $posts = Post::query()
            ->with('media', 'createdBy', 'dependencies')
            ->filterByTitle(request('title'))
            ->filterByPublishedAt(request('published_at'))
            ->filterByContentType(request('content_type', []))
            ->orderByDesc('published_at')
            ->paginate(10)
            ->withQueryString();

        $filters = [
            'title' => request('title', ''),
            'published_at' => request('published_at', ''),
            'content_type' => request('content_type', []),
        ];

        return Inertia::render('News/Index', [
            'posts' => PostResource::collection($posts),
            'filters' => $filters,
            'showDependency' => false,
        ]);
    }
}
