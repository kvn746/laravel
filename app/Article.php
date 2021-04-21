<?php

namespace App;

class Article extends \Illuminate\Database\Eloquent\Model
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
