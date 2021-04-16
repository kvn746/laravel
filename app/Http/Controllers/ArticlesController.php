<?php

namespace App\Http\Controllers;

use App\Articles;
use App\Http\FormRequest;
use App\Services;

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

    public function store()
    {
        $data = FormRequest::articleValidate(request());

        Articles::create($data);

        \Session::flash('message', 'Статья "' . $data['slug'] . '" успешно создана!');

        return redirect()->route('articles.index');
    }

    public function edit(Articles $article)
    {
        return view('articles.edit', compact('article'));
    }

    public function update(Articles $article)
    {
        $slug = Services::getSlug(request('title'));

        if ($article->slug == $slug) {
            $slug = false;
        }

        $data = FormRequest::articleValidate(request(), $slug);

        $article->update($data);

        \Session::flash('message', 'Статья "' . $article->slug . '" успешно изменена!');

        return redirect()->route('articles.index');
    }

    public function destroy(Articles $article)
    {
        $article->delete();

        \Session::flash('message', 'Статья "' . $article->slug . '" успешно удалена!');

        return redirect()->route('articles.index');
    }
}
