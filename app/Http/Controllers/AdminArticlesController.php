<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Middleware\Admin;
use App\Http\Requests\ArticleFormRequest;
use App\Services\ArticleServiceContract;
use App\Services\TagsSynchronizer;

class AdminArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware(Admin::class);
    }

    public function index()
    {
        $articles = \Cache::tags('articles')->remember('admin_article' . auth()->id(), 3600, function () {
            return Article::with('tags')->latest()->paginate(20);
        });

        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
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

    public function store(ArticleFormRequest $request, TagsSynchronizer $tagsSync, ArticleServiceContract $createArticle)
    {
        $createArticle->createArticle($request, $tagsSync);

        return redirect()->route('admin.articles.index');
    }

    public function update(Article $article, ArticleFormRequest $request, TagsSynchronizer $tagsSync, ArticleServiceContract $updateArticle)
    {
        $updateArticle->updateArticle($article, $request, $tagsSync);

        return redirect()->route('admin.articles.index');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('admin.articles.index');
    }
}
