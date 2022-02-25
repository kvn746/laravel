<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model implements Taggable
{
    protected $fillable = ['slug', 'title', 'text', 'description', 'is_public', 'owner_id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function comment()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
