@extends('layout.master')

@section('title', 'Создать статью')

@section('content')
    <div class="col-md-8">
        <h3 class="pb-4 mb-4 fst-italic border-bottom">
            Изменить статью
        </h3>
        <form method="POST" action="{{ route('articles.update', ['article' => $article]) }}">

            @csrf
            @method("PATCH")
            @include('articles.fields')

            <button type="submit" class="btn btn-primary">Изменить статью</button>
        </form>
        <form method="POST" action="{{ route('articles.destroy', ['article' => $article]) }}">

            @csrf
            @method("DELETE")

            <button type="submit" class="btn btn-danger">Удалить статью</button>
        </form>
    </div>
@endsection
