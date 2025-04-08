<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Dependency;
use App\Models\Post;
use Inertia\Inertia;

class SegobNewsController extends Controller
{
    public function __invoke()
    {
        $segobDependency = Dependency::where('name', 'segob')->first();

        $query = Post::query()
            ->with('media', 'createdBy')
            ->whereHas('dependencies', function ($query) use ($segobDependency) {
                $query->when($segobDependency, function ($query) use ($segobDependency) {
                    $query->where('dependency_id', $segobDependency->id);
                });
            })
            ->filterByTitle(request('title'))
            ->filterByPublishedAt(request('published_at'))
            ->filterByContentType(request('content_type', []));

        $posts = $query
            ->orderByDesc('published_at')
            ->paginate(10)
            ->appends(request()->query());

        $filters = [
            'title' => request('title', ''),
            'published_at' => request('published_at', ''),
            'content_type' => request('content_type', []),
        ];

        return Inertia::render('SegobNews/Index', [
            'posts' => PostResource::collection($posts),
            'filters' => $filters,
            'showDependency' => false,
        ]);
    }
}
