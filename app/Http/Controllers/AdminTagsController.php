<?php

namespace App\Http\Controllers;

use App\Tag;

class AdminTagsController extends Controller
{
    public function index(Tag $tag)
    {
        $articles = $tag->articles()->with('tags')->latest()->get();

        return view('admin.articles.index', compact('articles'));
    }
}
