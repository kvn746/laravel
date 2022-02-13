<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleHistory extends Model
{
    protected $guarded = [];

    protected $casts = [
        'old-value' => 'array',
        'new-value' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
