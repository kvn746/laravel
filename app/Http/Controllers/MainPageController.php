<?php

namespace App\Http\Controllers;

use App\Article;
use App\News;

class MainPageController extends Controller
{
    public function index()
    {
        $title = ' последние';

        $articles = \Cache::tags(['articles', 'tags'])->remember('users_main_article', 3600, function () {
            return Article::with('tags')->latest()->paginate(5);
        });

        $news = \Cache::tags(['news', 'tags'])->remember('users_main_news', 3600, function () {
            return News::with('tags')->latest()->paginate(5);
        });

        return view('index', compact('articles', 'news', 'title'));
    }
}
