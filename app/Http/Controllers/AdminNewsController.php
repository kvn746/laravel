<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Admin;
use App\Http\Requests\NewsFormRequest;
use App\News;
use Illuminate\Http\Request;

class AdminNewsController extends Controller
{
    public function __construct()
    {
        $this->middleware(Admin::class);
    }

    public function index()
    {
        $news = News::with('tags')
            ->latest()
            ->paginate(20);

        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function show(News $news)
    {
        return view('admin.news.show', compact('news'));
    }

    public function store(NewsFormRequest $request)
    {
        News::create($request->validated());

        return redirect()->route('admin.news.index');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(News $news, NewsFormRequest $request)
    {
        $news->update($request->validated());

        return redirect()->route('admin.news.index');
    }

    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('admin.news.index');
    }
}
