<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\CommentFormRequest;
use App\Services\CommentServiceContract;

class ArticlesCommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(CommentFormRequest $request, CommentServiceContract $comment, Article $model)
    {
        $comment->createComment($request, $model);
        return redirect()->back();
    }
}
