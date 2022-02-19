<?php

namespace App\Http\Controllers;

use App\Tag;

class TagsController extends Controller
{
    public function index(Tag $tag)
    {
        $articles = $tag->articles()->with('tags')->latest()->paginate(5);
        $news = $tag->news()->with('tags')->latest()->paginate(5);

        return view('index', compact('articles', 'news'));
    }
}
