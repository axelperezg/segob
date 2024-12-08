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

            'audio_id' => $this->audio_id,
            'document_id' => $this->document_id,
            'photo_gallery_id' => $this->photo_gallery_id,
            'video_id' => $this->video_id,

            'photoGallery' => PhotoGalleryResource::make($this->whenLoaded('photoGallery')),
            'document' => DocumentResource::make($this->whenLoaded('document')),
            'audio' => AudioResource::make($this->whenLoaded('audio')),
            'video' => VideoResource::make($this->whenLoaded('video')),
        ];
    }
}
