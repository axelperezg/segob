<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Video extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'is_published',
        'published_at',
        'title',
        'url',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'date',
            'is_published' => 'boolean',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('image')
            ->singleFile();
    }

    public function scopeFilterByPublishedAt($query, $date)
    {
        return $query->when(
            $date, fn ($query) => $query->whereDate('published_at', $date)
        );
    }

    public function scopeSearchByTitle($query, $title)
    {
        return $query->when(
            $title, fn ($query) => $query->where('title', 'like', "%{$title}%")
        );
    }
}
