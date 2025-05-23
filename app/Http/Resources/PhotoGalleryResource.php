<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PhotoGalleryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'is_published' => $this->is_published,
            'published_at' => $this->published_at,
            'name' => $this->name,
            'slug' => $this->slug,
            'photos' => $this->getMedia('gallery')->map(fn ($photo) => $photo->getFullUrl()),
            'image' => $this->image
                ? Storage::disk('public')->url($this->image)
                : 'https://placehold.co/600x350',

            'posts' => PostResource::collection($this->whenLoaded('posts')),
        ];
    }
}
