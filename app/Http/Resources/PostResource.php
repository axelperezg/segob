<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'keywords' => $this->keywords,
            'slug' => $this->slug,
            'featured_image' => $this->getFirstMedia('image')?->getFullUrl(),
            'is_published' => $this->is_published,
            'content_type' => $this->content_type->getLabel(),
            'state' => $this->state,
            'published_at' => $this->published_at,
            'created_by' => UserResource::make($this->whenLoaded('createdBy')),
        ];
    }
}
