<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MexicoNewsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'excerpt' => $this->excerpt,
            'keywords' => $this->keywords,
            'slug' => $this->slug,
            'featured_image' => $this->getFirstMedia('image')?->getFullUrl() ?? 'https://placehold.co/600x350',
            'is_published' => $this->is_published,
            'image' => $this->image ?? 'https://placehold.co/600x350',
            'states' => $this->states->map(fn ($state) => [
                'id' => $state->id,
                'name' => $state->name,
            ]),
            'published_at' => $this->published_at,
            'created_by' => $this->created_by,
            'createdBy' => UserResource::make($this->whenLoaded('createdBy')),
        ];
    }
} 