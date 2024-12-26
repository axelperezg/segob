<?php

namespace App\Models;

use App\Enums\MexicanStateEnum;
use App\Enums\Posts\ContentTypeEnum;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'content',
        'keywords',
        'slug',
        'is_published',
        'content_type',
        'bulletin',
        'year',
        'state',
        'published_at',
        'created_by',
        'audio_id',
        'document_id',
        'photo_gallery_id',
        'video_id',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'date',
            'is_published' => 'boolean',
            'content_type' => ContentTypeEnum::class,
            'state' => MexicanStateEnum::class,
        ];
    }

    public function audio(): BelongsTo
    {
        return $this->belongsTo(Audio::class);
    }

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }

    public function photoGallery(): BelongsTo
    {
        return $this->belongsTo(PhotoGallery::class);
    }

    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function actions(): BelongsToMany
    {
        return $this->belongsToMany(Action::class);
    }

    public function dependencies(): BelongsToMany
    {
        return $this->belongsToMany(Dependency::class);
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('image')
            ->singleFile()
            ->useDisk('public');

        $this
            ->addMediaCollection('documents')
            ->useDisk('public');
    }

    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        return $query->when(
            $search,
            fn (Builder $query, string $search) => $query->where('title', 'like', "%{$search}%")
        );
    }

    public function scopeFilterByContentType(Builder $query, ?string $contentType): Builder
    {
        return $query->when(
            $contentType,
            fn (Builder $query, string $contentType) => $query->where('content_type', $contentType)
        );
    }

    public function scopeFilterByPublishedAt(Builder $query, ?string $publishedAt): Builder
    {
        return $query->when(
            $publishedAt,
            fn (Builder $query, string $publishedAt) => $query->whereDate('published_at', $publishedAt)
        );
    }
}
