<?php

namespace App\Http\Controllers;

use App\Http\Resources\ActionResource;
use App\Http\Resources\PostResource;
use App\Models\Action;
use Inertia\Inertia;

class ActionController extends Controller
{
    public function __invoke(Action $action)
    {
        $action->load('posts', 'media');

        $mainPosts = $action->posts()->orderBy('created_at', 'desc')->take(7)->get();
        $posts = $action->posts()
            ->search(request('search'))
            ->orderBy('created_at', 'desc')
            ->skip(7)
            ->paginate(10);

        return Inertia::render('Actions/Show', [
            'action' => ActionResource::make($action),
            'posts' => PostResource::collection($posts),
            'mainPosts' => PostResource::collection($mainPosts),
            'search' => request('search'),
        ]);
    }
}
