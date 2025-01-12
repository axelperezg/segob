<?php

namespace App\Http\Controllers;

use App\Enums\Documents\DocumentTypeEnum;
use App\Http\Resources\ActionResource;
use App\Http\Resources\BannerResource;
use App\Http\Resources\DependencyResource;
use App\Http\Resources\DocumentResource;
use App\Http\Resources\PhotoGalleryResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\VideoResource;
use App\Models\Action;
use App\Models\Banner;
use App\Models\Dependency;
use App\Models\Document;
use App\Models\FeaturedPost;
use App\Models\PhotoGallery;
use App\Models\Video;
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

        $infographics = Document::query()
            ->where('type', DocumentTypeEnum::INFOGRAPHIC)
            ->latest()
            ->limit(10)
            ->get();

        return Inertia::render('Home', [
            'mainPosts' => PostResource::collection($featuredPosts->slice(0, 1)),
            'secondaryPosts' => PostResource::collection($featuredPosts->slice(1, 2)),
            'tertiaryPosts' => PostResource::collection($featuredPosts->slice(3)),
            'actions' => ActionResource::collection(Action::query()->get()->reverse()),
            'banners' => BannerResource::collection(Banner::query()->limit(4)->latest()->get()),
            'dependencies' => DependencyResource::collection(Dependency::query()->latest()->get()),
            'infographics' => DocumentResource::collection($infographics),
            'mediaGallery' => [
                'photos' => PhotoGalleryResource::collection(PhotoGallery::query()->latest()->limit(8)->get()),
                'videos' => VideoResource::collection(Video::query()->latest()->limit(8)->get()),
            ],
        ]);
    }
}
