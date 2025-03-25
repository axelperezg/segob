<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class MexicoNews extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'url',
        'published_at',
        'mexico_dependency_id',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function mexicoDependency(): BelongsTo
    {
        return $this->belongsTo(MexicoDependency::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')
            ->singleFile()
            ->useDisk('public');

        $this->addMediaCollection('document')
            ->singleFile()
            ->useDisk('public');
    }
}
