<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ActionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'banner' => $this->banner
                ? Storage::disk('public')->url($this->banner)
                : 'https://placehold.co/600x350',
            'image' => $this->image
                ? Storage::disk('public')->url($this->image)
                : 'https://placehold.co/600x350',
            'posts' => PostResource::collection($this->whenLoaded('posts')),
        ];
    }
}
