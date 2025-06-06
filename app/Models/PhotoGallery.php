<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PhotoGallery extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'is_published',
        'published_at',
        'name',
        'slug',
        'image',
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
            ->useDisk('public')
            ->singleFile();

        $this->addMediaCollection('gallery')
            ->useDisk('public');
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function scopeSearchByName(Builder $query, ?string $name): Builder
    {
        return $query
            ->when(
                $name,
                fn ($query, $name) => $query->where('name', 'like', "%{$name}%")
            );
    }

    public function scopeFilterByPublishedAt(Builder $query, ?string $publishedAt): Builder
    {
        return $query
            ->when(
                $publishedAt,
                fn ($query, $publishedAt) => $query->where('published_at', $publishedAt)
            );
    }
}
