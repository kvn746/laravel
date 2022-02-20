<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentFormRequest;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(CommentFormRequest $request, Comment $comment)
    {
        $comment::create($request->validated());
        return redirect()->back();
    }
}
