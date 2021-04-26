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
        $tags = collect(explode(',', request('tags')))->keyBy(function ($item) { return $item; });

        $article = Article::create($request->validated());

        $tagsSync->sync($tags, $article);

        \Session::flash('message', 'Статья "' . $request->request->get('slug') . '" успешно создана!');

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

        $tags = collect(explode(',', request('tags')))->keyBy(function ($item) { return $item; });

        $tagsSync->sync($tags, $article);

        \Session::flash('message', 'Статья "' . $request->request->get('slug') . '" успешно изменена!');

        return redirect()->route('articles.index');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        \Session::flash('message', 'Статья "' . $article->slug . '" успешно удалена!');

        return redirect()->route('articles.index');
    }
}
