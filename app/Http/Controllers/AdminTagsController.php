<?php

namespace App\Http\Controllers;

use App\Tag;

class AdminTagsController extends Controller
{
    public function index(Tag $tag)
    {
        $articles = $tag->articles()->with('tags')->latest()->paginate(5);
        $news = $tag->news()->with('tags')->latest()->paginate(5);

        return view('admin.index', compact('articles', 'news'));
    }
}
