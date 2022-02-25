<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentFormRequest;
use App\News;
use App\Services\CommentServiceContract;

class NewsCommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(CommentFormRequest $request, CommentServiceContract $comment, News $model)
    {
        $comment->createComment($request, $model);
        return redirect()->back();
    }
}
