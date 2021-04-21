<?php

namespace App\Http\Controllers;

use App\Articles;
use App\Http\FormRequest;
use App\Http\Requests\ArticleFormRequest;

class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Articles::where('is_public', 1)->latest()->get();

        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function show(Articles $article)
    {
        return view('articles.show', compact('article'));
    }

    public function store(ArticleFormRequest $request)
    {
        Articles::create($request->validated());

        \Session::flash('message', 'Статья "' . $request->request->get('slug') . '" успешно создана!');

        return redirect()->route('articles.index');
    }

    public function edit(Articles $article)
    {
        return view('articles.edit', compact('article'));
    }

    public function update(Articles $article, ArticleFormRequest $request)
    {
        $article->update($request->validated());

        \Session::flash('message', 'Статья "' . $request->request->get('slug') . '" успешно изменена!');

        return redirect()->route('articles.index');
    }

    public function destroy(Articles $article)
    {
        $article->delete();

        \Session::flash('message', 'Статья "' . $article->slug . '" успешно удалена!');

        return redirect()->route('articles.index');
    }
}
