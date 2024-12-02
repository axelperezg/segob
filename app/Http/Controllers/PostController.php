<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function __invoke(Post $post)
    {
        $post->load('createdBy');

        return Inertia::render('Posts/Show', [
            'post' => PostResource::make($post),
        ]);
    }
}
