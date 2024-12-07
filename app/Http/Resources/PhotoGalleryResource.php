<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PhotoGalleryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'is_published' => $this->is_published,
            'published_at' => $this->published_at->format('d/m/Y'),
            'name' => $this->name,
            'photos' => $this->getMedia('gallery')->map(fn ($photo) => $photo->getFullUrl()),
        ];
    }
}
