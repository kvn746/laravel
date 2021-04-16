@extends('layout.master')

@section('title', 'Статья "' . $article->title . '"')

@section('content')
    <div class="col-md-8">
        <h3 class="pb-4 mb-4 fst-italic border-bottom">
            Просмотр статьи
        </h3>

        <article class="blog-post">
            <h2 class="blog-post-title">{{ $article->title }}</h2>
            <p class="blog-post-meta">{{ $article->created_at->toFormattedDateString() }}</p>

            {{ $article->text }}

        </article>
        <div>
            <a href="{{ Route('articles.index') . '/' . $article->slug . '/edit' }}">Редактировать</a>
        </div>
        <div class="border-top">
            <a  href="{{ route('articles.index') }}">К списку статей</a>
        </div>
    </div>
@endsection
