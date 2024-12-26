<?php

namespace App\Http\Controllers;

use App\Http\Resources\DependencyResource;
use App\Http\Resources\PostResource;
use App\Models\Dependency;
use App\Models\Post;
use Inertia\Inertia;
use Spatie\QueryBuilder\QueryBuilder;

class DependencyController extends Controller
{
    public function __invoke(Dependency $dependency)
    {
        $dependency->load('media');

        $posts = QueryBuilder::for(Post::class)
            ->allowedFilters(['title'])
            ->filterByPublishedAt(request('published_at'))
            ->with('media', 'createdBy')
            ->when(request('content_type'), fn ($query) => $query->whereIn('content_type', request('content_type')))
            ->whereRelation('dependencies', 'dependency_id', $dependency->id)
            ->paginate(1)
            ->withQueryString();

        $filters = [
            'title' => request('filter.title', ''),
            'published_at' => request('published_at', ''),
            'content_type' => request('content_type', []),
        ];

        return Inertia::render('Dependencies/Show', [
            'dependency' => DependencyResource::make($dependency),
            'filters' => $filters,
            'posts' => PostResource::collection($posts),
        ]);
    }
}
