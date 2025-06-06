<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class VideoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'url' => $this->url,
            'published_at' => $this->published_at,
            'image' => $this->image
                ? Storage::disk('public')->url($this->image)
                : 'https://placehold.co/600x350',

            'posts' => PostResource::collection($this->whenLoaded('posts')),
        ];
    }
}
