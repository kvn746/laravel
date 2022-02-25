@extends('admin.master')

@section('title', 'Новости и статьи для тега')

@section('content')
    <div class="col-md-8">
        @if($news->count())
            <h3 class="pb-4 mb-4 fst-italic border-bottom">
                Новости{{ $title }}
            </h3>

            @foreach($news as $new)
                <article class="blog-post">
                    <h2 class="blog-post-title"><a href="{{ route('admin.news.show', $new) }}">{{ $new->title }}</a></h2>

                    @include('layout.tags', ['tags' => $new->tags])

                    <p class="blog-post-meta">{{ $new->created_at->toFormattedDateString() }}</p>

                    {{ $new->description }}

                </article>
            @endforeach

            <nav class="blog-pagination" aria-label="Pagination">
                {{ $news->links() }}
                {{--            <a class="btn btn-outline-primary" href="#">Newer</a>--}}
                {{--            <a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Older</a>--}}
            </nav>
        @endif
        @if($articles->count())
            <h3 class="pb-4 mb-4 fst-italic border-bottom">
                Статьи{{ $title }}
            </h3>

            @foreach($articles as $article)
                <article class="blog-post">
                    <h2 class="blog-post-title"><a href="{{ route('admin.articles.show', $article) }}">{{ $article->title }}</a></h2>

                    @include('admin.tags', ['tags' => $article->tags])

                    <p class="blog-post-meta">{{ $article->created_at->toFormattedDateString() }}</p>

                    {{ $article->description }}

                </article>
            @endforeach

            <nav class="blog-pagination" aria-label="Pagination">
                {{ $articles->links() }}
                {{--            <a class="btn btn-outline-primary" href="#">Older</a>--}}
                {{--            <a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Newer</a>--}}
            </nav>
        @endif
    </div>
@endsection
