<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model implements Taggable
{
    protected $fillable = ['slug', 'title', 'description', 'text', 'is_public'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
