<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class BannerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'external_url' => $this->external_url,
            'image' => $this->image 
                ? Storage::disk('public')->url($this->image)
                : 'https://placehold.co/600x100',
        ];
    }
}
