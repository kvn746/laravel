@extends('layout.master')

@section('title', 'Создать статью')

@section('content')
    <div class="col-md-8">
        <h3 class="pb-4 mb-4 fst-italic border-bottom">
            Создать статью
        </h3>
        <form method="POST" action="{{ route('articles.store') }}">

            @csrf
            @include('articles.fields', ['article' => new App\Articles()])

            <button type="submit" class="btn btn-primary">Сохранить статью</button>
        </form>
    </div>
@endsection
