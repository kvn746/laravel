<?php

namespace App\Http\Controllers;

use App\Tag;

class TagsController extends Controller
{
    public $tag;

    public function index(Tag $tag)
    {
        $this->tag = $tag;
        $title = ' с тегом ' . $this->tag->name;

        $articles = \Cache::tags('tags')->remember('users_tags_article' . $this->tag->name . auth()->id(), 3600, function () {
            return $this->tag->articles()->with('tags')->latest()->paginate(5);
        });

        $news = \Cache::tags('tags')->remember('users_tags_news' . $this->tag->name . auth()->id(), 3600, function () {
            return $this->tag->news()->with('tags')->latest()->paginate(5);
        });

        return view('index', compact('articles', 'news', 'title'));
    }
}
