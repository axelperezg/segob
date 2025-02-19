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
            'excerpt' => $this->excerpt,
            'keywords' => $this->keywords,
            'slug' => $this->slug,
            'featured_image' => $this->getFirstMedia('image')?->getFullUrl() ?? 'https://placehold.co/600x350',
            'is_published' => $this->is_published,
            'content_type' => $this->content_type->getLabel(),
            'states' => $this->states->map(fn ($state) => [
                'id' => $state->id,
                'name' => $state->name,
            ]),
            'published_at' => $this->published_at,
            'dependencies' => DependencyResource::collection($this->whenLoaded('dependencies')),
            'bulletin' => $this->bulletin,
            'year' => $this->year,

            'audio_id' => $this->audio_id,
            'document_id' => $this->document_id,
            'photo_gallery_id' => $this->photo_gallery_id,
            'video_id' => $this->video_id,
            'created_by' => $this->created_by,
            'stenographic_version_id' => $this->stenographic_version_id,

            'photoGallery' => PhotoGalleryResource::make($this->whenLoaded('photoGallery')),
            'document' => DocumentResource::make($this->whenLoaded('document')),
            'audio' => AudioResource::make($this->whenLoaded('audio')),
            'video' => VideoResource::make($this->whenLoaded('video')),
            'createdBy' => UserResource::make($this->whenLoaded('createdBy')),
            'stenographicVersion' => PostResource::make($this->whenLoaded('stenographicVersion')),
        ];
    }
}
