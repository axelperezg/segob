<?php

namespace App\Http\Controllers;

use App\Http\Resources\MexicoNewsResource;
use App\Models\MexicoNews;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MexicoNewsController extends Controller
{
    public function __invoke(Request $request)
    {
        $mainPosts = MexicoNews::query()
            ->when($request->published_at, function ($query) use ($request) {
                return $query->whereDate('published_at', $request->published_at);
            })
            ->with('mexicoDependency', 'media')
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        $posts = MexicoNews::query()
            ->when($request->published_at, function ($query) use ($request) {
                return $query->whereDate('published_at', $request->published_at);
            })
            ->with('mexicoDependency', 'media')
            ->orderBy('published_at', 'desc')
            ->skip(3)
            ->paginate(5)
            ->appends($request->all());

        $filters = [
            'published_at' => request('published_at', today()->format('Y-m-d')),
        ];

        return Inertia::render('MexicoNews', [
            'mainPosts' => MexicoNewsResource::collection($mainPosts),
            'posts' => MexicoNewsResource::collection($posts),
            'filters' => $filters,
        ]);
    }
}
