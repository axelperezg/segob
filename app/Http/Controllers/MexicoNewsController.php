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
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        $posts = MexicoNews::query()
            ->orderBy('published_at', 'desc')
            ->skip(3)
            ->paginate(10);

        return Inertia::render('MexicoNews', [
            'mainPosts' => MexicoNewsResource::collection($mainPosts),
            'posts' => MexicoNewsResource::collection($posts),
        ]);
    }
}
