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
            'published_at' => $this->published_at,
            'is_published' => $this->is_published,
            'type' => $this->type->getLabel(),
            'document_section' => $this->document_section->getLabel(),
            'document_file' => $this->getFirstMedia('document')?->getFullUrl(),
            'image' => $this->getFirstMedia('image')?->getFullUrl() ?? 'https://via.placeholder.com/1000x1000',
        ];
    }
}
