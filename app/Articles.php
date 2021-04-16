<?php

namespace App;

class Articles extends Model
{
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
