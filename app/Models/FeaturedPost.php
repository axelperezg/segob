<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FeaturedPost extends Model
{
    protected $fillable = [
        'post_id',
        'sort',
        'is_active',
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
