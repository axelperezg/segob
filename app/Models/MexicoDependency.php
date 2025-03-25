<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MexicoDependency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function mexicoNews(): HasMany
    {
        return $this->hasMany(MexicoNews::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')
            ->singleFile()
            ->useDisk('public');
    }
}
