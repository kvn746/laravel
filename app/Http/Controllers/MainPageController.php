<?php

namespace App\Http\Controllers;

use App\Article;
use App\News;

class MainPageController extends Controller
{
    public function index()
    {
        $title = ' последние';

        $articles = \Cache::tags(['articles', 'tags'])->remember('users_main_article_' . auth()->user()->userRoles->name, 3600, function () {
            return Article::with('tags')
                ->when(! auth()->check() || (! auth()->user()->isAdmin() && ! auth()->user()->isModerator()), function ($query) {
                    return $query->where('is_public', 1)
                        ->when(auth()->check(), function ($query) {
                            return $query->orWhere('owner_id', auth()->user()->id);
                        });
                })
                ->latest()
                ->paginate(5);
        });

        $news = \Cache::tags(['news', 'tags'])->remember('users_main_news', 3600, function () {
            return News::with('tags')
                ->where('is_public', 1)
                ->latest()
                ->Paginate(5);
        });

        return view('index', compact('articles', 'news', 'title'));
    }
}
