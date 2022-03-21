<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\ArticleFormRequest;
use App\Services\TagsSynchronizer;
use App\Services\ArticleServiceContract;

class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show']]);
    }

    public function index()
    {
        $articles = \Cache::tags('articles')->remember('users_article' . auth()->id(), 3600, function () {
            return Article::with('tags')
                ->when(! auth()->check() || (! auth()->user()->isAdmin() && ! auth()->user()->isModerator()), function ($query) {
                    return $query->where('is_public', 1)
                        ->when(auth()->check(), function ($query) {
                            return $query->orWhere('owner_id', auth()->user()->id);
                        });
                })
                ->latest()
                ->paginate(10);
        });

        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function store(ArticleFormRequest $request, TagsSynchronizer $tagsSync, ArticleServiceContract $createArticle)
    {
        $createArticle->createArticle($request, $tagsSync);

        return redirect()->route('articles.index');
    }

    public function edit(Article $article)
    {
        $this->authorize('update', $article);

        return view('articles.edit', compact('article'));
    }

    public function update(Article $article, ArticleFormRequest $request, TagsSynchronizer $tagsSync, ArticleServiceContract $updateArticle)
    {
        $updateArticle->updateArticle($article, $request, $tagsSync);

        return redirect()->route('articles.index');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('articles.index');
    }
}
