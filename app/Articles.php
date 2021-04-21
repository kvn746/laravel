<?php

namespace App;

class Articles extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = ['slug', 'title', 'description', 'text', 'is_public'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
