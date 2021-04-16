<?php

namespace App\Http\Controllers;

use App\Articles;
use App\Exceptions\Handler;
use App\Services;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Articles::where('is_public', 1)->latest()->get();

        return view('articles.index', compact('articles'));
    }

    public function add()
    {
        return view('articles.create');
    }

    public function show(Articles $article)
    {
        return view('articles.show', compact('article'));
    }

    public function create()
    {
        $slug = Services::getSlug(request('title'));

        request()->request->add(['slug' => Services::getSlug(request('title'))]);

        $data = $this->validate(request(), [
            'title' => 'required|min:5|max:100',
            'description' => 'required|max:255',
            'text' => 'required',
            'slug' => 'unique:articles,slug',
        ]);

        $data = array_merge($data, ['is_public' => (bool) request('is_public')]);

         Articles::create($data);

        return redirect()->route('articles');
    }
}
