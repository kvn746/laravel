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

        $articles = \Cache::tags(['tags', 'articles'])->remember('users_tags_article' . auth()->id() . $this->tag->name, 3600, function () {
            return $this->tag->articles()
                ->with('tags')
                ->when(! auth()->check() || (! auth()->user()->isAdmin() && ! auth()->user()->isModerator()), function ($query) {
                    return $query->where('is_public', 1)
                        ->when(auth()->check(), function ($query) {
                            return $query->orWhere('owner_id', auth()->user()->id);
                        });
                })
                ->latest()
                ->paginate(5);
        });

        $news = \Cache::tags(['tags', 'news'])->remember('users_tags_news' . $this->tag->name, 3600, function () {
            return $this->tag->news()
                    ->with('tags')
                    ->where('is_public', 1)
                    ->latest()
                    ->Paginate(5);
        });

//        $articles = \Cache::tags(['tags', 'articles'])->remember('users_tags_article' . $this->tag->name, 3600, function () {
//            return $this->tag->articles()->with('tags')->latest()->paginate(5);
//        });
//
//        $news = \Cache::tags(['tags', 'news'])->remember('users_tags_news' . $this->tag->name, 3600, function () {
//            return $this->tag->news()->with('tags')->latest()->paginate(5);
//        });

        return view('index', compact('articles', 'news', 'title'));
    }
}
