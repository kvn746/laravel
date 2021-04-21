<?php

namespace App\Services;

use Illuminate\Support\Collection;
use App\Tag;
use Illuminate\Database\Eloquent\Model;

class TagsSynchronizer
{
    public function sync(Collection $tags, Model $model)
    {
        $modelTags = $model->tags->keyBy('name');

        $syncIds = $modelTags->intersectByKeys($tags)->pluck('id')->toArray();

        $tagsToAttach = $tags->diffKeys($modelTags);

        foreach($tagsToAttach as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);

            $syncIds[] = $tag->id;
        }

        $model->tags()->sync($syncIds);
    }
}
