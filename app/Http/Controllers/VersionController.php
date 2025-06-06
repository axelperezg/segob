<?php

namespace App\Http\Controllers;

use App\Enums\Posts\ContentTypeEnum;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Inertia\Inertia;

class VersionController extends Controller
{
    public function __invoke()
    {
        $posts = Post::query()
            ->with('media', 'createdBy', 'dependencies')
            ->filterByTitle(request('title'))
            ->filterByPublishedAt(request('published_at'))
            ->filterByDependency(request('dependency_id'))
            ->where('content_type', ContentTypeEnum::STENOGRAPHIC_VERSION)
            ->orderByDesc('published_at')
            ->paginate(10)
            ->withQueryString();

        $filters = [
            'title' => request('title', ''),
            'published_at' => request('published_at', ''),
            'dependency_id' => request('dependency_id', ''),
        ];

        return Inertia::render('Version', [
            'posts' => PostResource::collection($posts),
            'filters' => $filters,
        ]);
    }
}
