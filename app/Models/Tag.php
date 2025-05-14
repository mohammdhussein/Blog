<?php

namespace App\Models;

use Database\Factories\TagFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tag extends Model
{
    /** @use HasFactory<TagFactory> */
    use HasFactory;

    public function jobs(): BelongsToMany
    {
        return $this->belongsToMany(Job::class, relatedPivotKey: 'job_listing_id');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, foreignPivotKey: 'tag_id');
    }

}
