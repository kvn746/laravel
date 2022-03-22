<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Admin;
use App\Article;
use App\News;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(Admin::class);
    }

    public function index()
    {
        $title = ' последние';
        $articles = \Cache::tags(['articles', 'tags'])->remember('admin_main_article', 3600, function () {
            return Article::with('tags')->latest()->paginate(5);
        });
        $news = \Cache::tags(['news', 'tags'])->remember('admin_main_news', 3600, function () {
            return News::with('tags')->latest()->paginate(5);
        });

        return view('admin.index', compact('articles', 'news', 'title'));
    }

}
