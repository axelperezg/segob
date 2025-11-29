<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Inertia\Inertia;

class PostController extends Controller
{
    public function __invoke(Post $post)
    {
        $post->load('createdBy', 'photoGallery.media', 'document', 'audio', 'video', 'dependencies', 'stenographicVersion');

        return view('pages.posts.show', [
            'post' => $post,
        ]);
    }
}
