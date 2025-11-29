<?php

namespace App\Http\Controllers;

use App\Models\Post;

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

        return view('pages.news.index', [
            'posts' => $posts,
            'filters' => $filters,
        ]);
    }
}
