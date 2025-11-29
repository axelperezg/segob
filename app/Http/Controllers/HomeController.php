<?php

namespace App\Http\Controllers;

use App\Enums\Documents\DocumentTypeEnum;
use App\Models\Action;
use App\Models\Banner;
use App\Models\Dependency;
use App\Models\Document;
use App\Models\FeaturedPost;
use App\Models\PhotoGallery;
use App\Models\Video;

class HomeController extends Controller
{
    public function __invoke()
    {
        $featuredPosts = FeaturedPost::query()
            ->with('post.media', 'post.states')
            ->whereHas('post', fn ($query) => $query->where('is_published', true))
            ->orderBy('sort')
            ->get()
            ->map(fn ($featuredPost) => $featuredPost->post);

        $infographics = Document::query()
            ->where('type', DocumentTypeEnum::INFOGRAPHIC)
            ->latest()
            ->limit(10)
            ->get();

        return view('pages.home.index', [
            'mainPosts' => $featuredPosts->slice(0, 1),
            'secondaryPosts' => $featuredPosts->slice(1, 2),
            'tertiaryPosts' => $featuredPosts->slice(3),
            'actions' => Action::query()->get()->reverse(),
            'banners' => Banner::query()->limit(4)->latest()->get(),
            'dependencies' => Dependency::query()->latest()->get(),
            'infographics' => $infographics,
            'photos' => PhotoGallery::query()->latest()->limit(8)->get(),
            'videos' => Video::query()->latest()->limit(8)->get(),
        ]);
    }
}
