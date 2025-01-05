<?php

namespace App\Http\Controllers;

use App\Http\Resources\VideoResource;
use App\Models\Video;
use Inertia\Inertia;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::query()
            ->where('is_published', true)
            ->orderByDesc('published_at')
            ->paginate();

        return Inertia::render('Videos/Index', [
            'videos' => VideoResource::collection($videos),
        ]);
    }
}
