<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\FormRequest;
use App\Http\Requests\ArticleFormRequest;
use App\Services\TagsSynchronizer;

class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show']]);
    }

    public function index()
    {
        $articles = Article::with('tags')->where('is_public', 1)->latest()->get();

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

    public function store(ArticleFormRequest $request, TagsSynchronizer $tagsSync)
    {
        if (request('tags')) {
            $tags = collect(explode(',', request('tags')))->keyBy(function ($item) { return $item; });
        } else {
            $tags = collect();
        }

        $article = Article::create($request->validated());

        $tagsSync->sync($tags, $article);

        return redirect()->route('articles.index');
    }

    public function edit(Article $article)
    {
        $this->authorize('update', $article);

        return view('articles.edit', compact('article'));
    }

    public function update(Article $article, ArticleFormRequest $request, TagsSynchronizer $tagsSync)
    {
        $article->update($request->validated());

        if (request('tags')) {
            $tags = collect(explode(',', request('tags')))->keyBy(function ($item) { return $item; });
        } else {
            $tags = collect();
        }

        $tagsSync->sync($tags, $article);

        return redirect()->route('articles.index');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('articles.index');
    }
}
