<?php

namespace App\Http\Controllers;

use App\News;
use App\Http\Middleware\Admin;
use App\Http\Requests\NewsFormRequest;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware(Admin::class, ['except' => ['index','show']]);
    }

    public function index()
    {
        $news = \Cache::tags('news')->remember('users_news' . auth()->id(), 3600, function () {
            return News::with('tags')
                ->where('is_public', 1)
                ->latest()
                ->Paginate(10);
        });

        return view('news.index', compact('news'));
    }

    public function create()
    {
        return view('news.create');
    }

    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    public function store(NewsFormRequest $request)
    {
        News::create($request->validated());

        return redirect()->route('news.index');
    }

    public function edit(News $news)
    {
        $this->authorize('update', $news);

        return view('news.edit', compact('news'));
    }

    public function update(News $news, NewsFormRequest $request)
    {
        $news->update($request->validated());

        return redirect()->route('news.index');
    }

    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('news.index');
    }
}
