<?php

namespace App;

use App\Events\ArticleCreated;
use App\Events\ArticleDeleted;
use App\Events\ArticleUpdated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Article extends Model implements Taggable
{
    protected $fillable = ['slug', 'title', 'description', 'text', 'is_public', 'owner_id'];

    protected $dispatchesEvents = [
        'created' => ArticleCreated::class,
        'updated' => ArticleUpdated::class,
        'deleted' => ArticleDeleted::class,
    ];

    protected static function boot()
    {
        parent::boot();

        static::updating(function (Article $article) {
            $newValue = $article->getDirty();
            $oldValue = Arr::only($article->fresh()->toArray(), array_keys($newValue));
            $article->history()->attach(auth()->id(), [
                'old_value' => $oldValue,
                'new_value' => $newValue,
            ]);
        });

        static::created(function () {
            \Cache::tags('articles')->flush();
        });

        static::updated(function () {
            \Cache::tags('articles')->flush();
        });

        static::deleted(function () {
            \Cache::tags('articles')->flush();
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function history()
    {
        return $this->belongsToMany(User::class, 'article_histories')
            ->withPivot(['old_value', 'new_value'])->withTimestamps()->using(ArticleHistory::class);
    }

    public function comment()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
