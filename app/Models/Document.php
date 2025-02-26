<?php

namespace App\Models;

use App\Enums\Documents\DocumentSectionEnum;
use App\Enums\Documents\DocumentTypeEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Document extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'is_published',
        'published_at',
        'name',
        'slug',
        'type',
        'document_section',
        'image',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'date',
            'is_published' => 'boolean',
            'type' => DocumentTypeEnum::class,
            'document_section' => DocumentSectionEnum::class,
        ];
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('image')
            ->singleFile()
            ->useDisk('public');

        $this
            ->addMediaCollection('document')
            ->singleFile()
            ->useDisk('public');
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function scopeSearchByName(Builder $query, ?string $name): Builder
    {
        return $query->when(
            $name,
            fn (Builder $query, string $name) => $query->where('name', 'like', "%{$name}%")
        );
    }

    public function scopeSearchByDocumentSection(Builder $query, ?string $documentSection): Builder
    {
        return $query->when(
            $documentSection,
            fn (Builder $query, string $documentSection) => $query->where('document_section', $documentSection)
        );
    }
}
