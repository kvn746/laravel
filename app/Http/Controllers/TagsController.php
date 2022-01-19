<?php

namespace App\Http\Controllers;

use App\Tag;

class TagsController extends Controller
{
    public function index(Tag $tag)
    {
        $articles = $tag->articles()->with('tags')->latest()->get();

        return view('articles.index', compact('articles'));
    }
}
