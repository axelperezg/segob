<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class DependencyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'image' => $this->image 
                ? Storage::disk('public')->url($this->image)
                : 'https://placehold.co/600x350',
            'banner' => $this->banner 
                ? Storage::disk('public')->url($this->banner)
                : 'https://placehold.co/600x200',
        ];
    }
}
