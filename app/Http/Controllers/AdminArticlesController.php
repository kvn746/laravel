<?php

namespace App\Http\Controllers;

use App\Article;

class AdminArticlesController extends ArticlesController
{
    public function index()
    {
        $articles = Article::with('tags')->latest()->get();

        return view('admin.articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        return view('admin.articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        $this->authorize('update', $article);

        return view('admin.articles.edit', compact('article'));
    }
}
