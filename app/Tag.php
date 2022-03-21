<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    protected static function boot()
    {
        parent::boot();

        static::created(function () {
            \Cache::tags('tags')->flush();
        });

        static::updated(function () {
            \Cache::tags('tags')->flush();
        });

        static::deleted(function () {
            \Cache::tags('tags')->flush();
        });
    }

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function articles()
    {
        return $this->morphedByMany(Article::class, 'taggable');
    }

    public function news()
    {
        return $this->morphedByMany(News::class, 'taggable');
    }

    public static function tagsCloud()
    {
        return static::has('articles')->get();
    }
}
