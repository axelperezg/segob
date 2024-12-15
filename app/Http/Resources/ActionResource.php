<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'banner' => $this->getFirstMediaUrl('banner') == null
                ? 'https://placehold.co/600x350'
                : $this->getFirstMediaUrl('banner'),
            'image' => $this->getFirstMediaUrl('image') == null
                ? 'https://placehold.co/600x350'
                : $this->getFirstMediaUrl('image'),

            'posts' => PostResource::collection($this->whenLoaded('posts')),
        ];
    }
}
