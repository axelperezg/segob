<?php

namespace App\Http\Resources;

use App\Models\MexicoNews;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

/**
 * @mixin MexicoNews
 */
class MexicoNewsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        if ($this->image) {
            $featuredImage = Storage::url($this->image);
        } else {
            $featuredImage = $this->mexicoDependency->getFirstMedia('image')?->getFullUrl() ?? 'https://placehold.co/600x350';
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'url' => $this->url,
            'featured_image' => $featuredImage,
            'published_at' => $this->published_at,
            'pdf' => $this->getFirstMedia('document')?->getFullUrl(),
            'mexico_dependency_id' => $this->mexico_dependency_id,
            'mexicoDependency' => new MexicoDependencyResource($this->whenLoaded('mexicoDependency')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
