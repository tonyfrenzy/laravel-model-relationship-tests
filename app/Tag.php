<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    /**
     * Get all of the posts that are associated with this tag.
     */
    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }

    /**
     * Get all of the videos that are associated with this tag.
     */
    public function videos()
    {
        return $this->morphedByMany(Video::class, 'taggable');
    }
}
