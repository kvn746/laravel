<?php

namespace App\Http\Controllers;

use App\Article;
use App\News;
use Illuminate\Http\Request;

class MainPageController extends Controller
{
    public function index()
    {
        $articles = Article::with('tags')->latest()->paginate(5);
        $news = News::with('tags')->latest()->paginate(5);

        return view('index', compact('articles', 'news'));
    }
}
