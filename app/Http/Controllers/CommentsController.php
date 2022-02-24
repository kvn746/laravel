<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\CommentFormRequest;
use App\News;
use App\Services\CommentServiceContract;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function articlesStore(CommentFormRequest $request, CommentServiceContract $comment, Article $model)
    {
        $comment->createComment($request, $model);
        return redirect()->back();
    }

    public function newsStore(CommentFormRequest $request, CommentServiceContract $comment, News $model)
    {
        $comment->createComment($request, $model);
        return redirect()->back();
    }
}
