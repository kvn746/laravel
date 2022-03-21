<?php

namespace App\Http\Controllers;

use App\Article;
use App\News;

class MainPageController extends Controller
{
    public function index()
    {
        $title = ' последние';

        $articles = \Cache::tags('articles')->remember('users_main_article' . auth()->id(), 3600, function () {
            return Article::with('tags')->latest()->paginate(5);
        });

        $news = \Cache::tags('news')->remember('users_main_news' . auth()->id(), 3600, function () {
            return News::with('tags')->latest()->paginate(5);
        });

        return view('index', compact('articles', 'news', 'title'));
    }
}
