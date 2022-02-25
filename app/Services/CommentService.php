<?php

namespace App\Services;

use App\Http\Requests\CommentFormRequest;
use Illuminate\Database\Eloquent\Model;

class CommentService implements CommentServiceContract
{
    public function createComment(CommentFormRequest $request, Model $model)
    {
        if ($request->get('commentable_type') === get_class($model)) {
            $model = $model->where('id', '=', $request->get('commentable_id'))->first();
            return $model->comment()->create($request->validated());
        }

        return null;
    }
}
