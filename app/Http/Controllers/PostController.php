<?php

namespace App\Http\Controllers;

use App\Models\Post;

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
