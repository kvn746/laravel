<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::created(function () {
            \Cache::tags('comments')->flush();
        });
    }

    public function user()
    {
        return $this->hasOne(User::class,'id', 'user_id');
    }

    public function article()
    {
        return $this->belongsTo(Article::class, 'commentable_id');
    }
}
