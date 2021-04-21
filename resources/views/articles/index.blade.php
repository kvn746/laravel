@extends('layout.master')

@section('title', 'Статьи')

@section('content')
    <div class="col-md-8">
        <h3 class="pb-4 mb-4 fst-italic border-bottom">
            From the Firehose
        </h3>

        @foreach($articles as $article)
            <article class="blog-post">
                <h2 class="blog-post-title"><a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a></h2>

                @include('articles.tags', ['tags' => $article->tags])

                <p class="blog-post-meta">{{ $article->created_at->toFormattedDateString() }}</p>

                {{ $article->text }}

            </article>
        @endforeach

        <nav class="blog-pagination" aria-label="Pagination">
            <a class="btn btn-outline-primary" href="#">Older</a>
            <a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Newer</a>
        </nav>

    </div>
@endsection
