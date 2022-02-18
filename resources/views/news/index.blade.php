@extends('layout.master')

@section('title', 'Новости')

@section('content')
    <div class="col-md-8">
        <h3 class="pb-4 mb-4 fst-italic border-bottom">
            Новости
        </h3>

        @foreach($news as $new)
            <article class="blog-post">
                <h2 class="blog-post-title"><a href="{{ route('news.show', $new) }}">{{ $new->title }}</a></h2>

{{--                @include('articles.tags', ['tags' => $article->tags])--}}

                <p class="blog-post-meta">{{ $new->created_at->toFormattedDateString() }}</p>

                {{ $new->description }}

            </article>
        @endforeach

        <nav class="blog-pagination" aria-label="Pagination">
            {{ $news->links() }}
{{--            <a class="btn btn-outline-primary" href="#">Older</a>--}}
{{--            <a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Newer</a>--}}
        </nav>

    </div>
@endsection
