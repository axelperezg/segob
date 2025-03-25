<?php

namespace App\Http\Resources;

use App\Models\MexicoNews;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin MexicoNews
 */
class MexicoNewsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'url' => $this->url,
            'featured_image' => $this->getFirstMedia('image')?->getFullUrl() ?? 'https://placehold.co/600x350',
            'published_at' => $this->published_at,
            'mexico_dependency_id' => $this->mexico_dependency_id,
            'mexicoDependency' => new MexicoDependencyResource($this->whenLoaded('mexicoDependency')),
            'documents' => $this->getMedia('documents')->map->getFullUrl(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
} 