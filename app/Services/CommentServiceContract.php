<?php

namespace App\Services;

use App\Http\Requests\CommentFormRequest;
use Illuminate\Database\Eloquent\Model;

interface CommentServiceContract
{
    public function createComment(CommentFormRequest $request, Model $model);
}
