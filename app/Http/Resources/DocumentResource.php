<?php

namespace App\Http\Resources;

use App\Enums\Documents\DocumentTypeEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class DocumentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'type' => $this->type,
            'document_section' => $this->document_section,
            'image' => $this->image
                ? Storage::disk('public')->url($this->image)
                : 'https://placehold.co/600x350',
            'images' => $this->getMedia('images')->map(fn ($image) => $image->getFullUrl()),
            'is_published' => $this->is_published,
            'published_at' => $this->published_at,
            'document' => $this->getFirstMedia('document')?->getFullUrl(),

            'posts' => PostResource::collection($this->whenLoaded('posts')),

            'isInfographic' => $this->type === DocumentTypeEnum::INFOGRAPHIC,
            'isPresentation' => $this->type === DocumentTypeEnum::PRESENTATION,
            'isPublication' => $this->type === DocumentTypeEnum::PUBLICATION,
        ];
    }
}
