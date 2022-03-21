<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Admin;
use Illuminate\Http\Request;
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
        $articles = \Cache::tags('articles')->remember('admin_main_article' . auth()->id(), 3600, function () {
            return Article::with('tags')->latest()->paginate(5);
        });
        $news = \Cache::tags('news')->remember('admin_main_news' . auth()->id(), 3600, function () {
            return News::with('tags')->latest()->paginate(5);
        });

        return view('admin.index', compact('articles', 'news', 'title'));
    }

}
