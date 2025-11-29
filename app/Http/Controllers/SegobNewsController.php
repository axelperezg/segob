<?php

namespace App\Http\Controllers;

use App\Models\Dependency;
use App\Models\Post;

class SegobNewsController extends Controller
{
    public function __invoke()
    {
        $segobDependency = Dependency::where('name', 'segob')->first();

        $query = Post::query()
            ->with('media', 'createdBy', 'dependencies')
            ->whereHas('dependencies', fn ($query) => $query->when(
                $segobDependency,
                fn ($query) => $query->where('dependency_id', $segobDependency->id)
            ))
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

        $dependencies = Dependency::query()->latest()->get();

        return view('pages.segob-news.index', [
            'posts' => $posts,
            'filters' => $filters,
            'dependencies' => $dependencies,
            'dependency' => $segobDependency,
        ]);
    }
}
