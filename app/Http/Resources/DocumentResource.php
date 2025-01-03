<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'document_section' => $this->document_section,
            'image' => $this->getFirstMedia('image')?->getFullUrl() ?? 'https://placehold.co/600x350',
            'is_published' => $this->is_published,
            'published_at' => $this->published_at
        ];
    }
}
