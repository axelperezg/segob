<?php

namespace App\Http\Resources;

use App\Models\MexicoDependency;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin MexicoDependency
 */
class MexicoDependencyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'featured_image' => $this->getFirstMedia('image')?->getFullUrl() ?? 'https://placehold.co/600x350',
            'mexico_news_count' => $this->whenCounted('mexicoNews'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
} 