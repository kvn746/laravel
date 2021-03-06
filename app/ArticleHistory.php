<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ArticleHistory extends Pivot
{
    protected $guarded = [];

    protected $casts = [
        'old_value' => 'array',
        'new_value' => 'array',
    ];

    protected $table = 'article_histories';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }
}
