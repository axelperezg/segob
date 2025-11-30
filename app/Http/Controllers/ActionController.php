<?php

namespace App\Http\Controllers;

use App\Models\Action;

class ActionController extends Controller
{
    public function __invoke(Action $action)
    {
        $action->load('media');

        $mainPosts = $action->posts()->orderBy('created_at', 'desc')->take(7)->get();
        $posts = $action->posts()
            ->search(request('search'))
            ->orderBy('created_at', 'desc')
            ->skip(7)
            ->paginate(10);

        return view('pages.actions.show', [
            'action' => $action,
            'posts' => $posts,
            'mainPosts' => $mainPosts,
        ]);
    }
}
