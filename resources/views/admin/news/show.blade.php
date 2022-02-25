@extends('admin.master')

@section('title', 'Новость "' . $news->title . '"')

@section('content')
    <div class="col-md-8">
        <h3 class="pb-4 mb-4 fst-italic border-bottom">
            Просмотр новости
        </h3>

        <article class="blog-post">
            <h2 class="blog-post-title">{{ $news->title }}</h2>
            <p class="blog-post-meta">{{ $news->created_at->toFormattedDateString() }}</p>

            {{ $news->text }}

            @include('admin.tags', ['tags' => $news->tags])

            @include('news_comments')

{{--            @include('news.history')--}}

        </article>
        <div>
            @editor
                <a href="{{ route('admin.news.edit', ['news' => $news]) }}">Редактировать</a>
            @endeditor
        </div>
        <div class="border-top">
            <a  href="{{ route('admin.news.index') }}">К списку новостей</a>
        </div>
    </div>
@endsection
