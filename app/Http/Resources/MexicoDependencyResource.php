<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MexicoDependencyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'website' => $this->website,
            'image' => $this->image ?? 'https://placehold.co/600x350',
            'banner' => $this->banner ?? 'https://placehold.co/600x200',
            'region' => $this->region,
            'contact_email' => $this->contact_email,
        ];
    }
} 