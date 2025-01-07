<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'image' => $this->getFirstMedia('image')?->getFullUrl() ?? 'https://via.placeholder.com/150',

            'posts' => PostResource::collection($this->whenLoaded('posts')),
        ];
    }
}
