<?php

namespace App\Http\Controllers;

use App\ArticleComment;
use App\Http\Requests\CommentFormRequest;

class ArticleCommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(CommentFormRequest $request, ArticleComment $comment)
    {
        $comment::create($request->all());
        return redirect()->back();
    }
}
