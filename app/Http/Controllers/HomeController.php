<?php

namespace App\Http\Controllers;

use App\Models\FeaturedPost;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function __invoke()
    {
        $featuredPosts = FeaturedPost::query()
            ->with('post.media')
            ->whereHas('post', fn ($query) => $query->where('is_published', true))
            ->orderBy('sort')
            ->get()
            ->map(function ($featuredPost) {
                $post = $featuredPost->post;
                $post->setAttribute('image', $post->getFirstMedia('image')?->getFullUrl());

                return $post;
            });

        return Inertia::render('Home', [
            'mainPosts' => $featuredPosts->slice(0, 1),
            'secondaryPosts' => $featuredPosts->slice(1, 2),
            'tertiaryPosts' => $featuredPosts->slice(3),
        ]);
    }
}
