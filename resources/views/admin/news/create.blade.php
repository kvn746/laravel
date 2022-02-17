@extends('admin.master')

@section('title', 'Создать новость')

@section('content')
    <div class="col-md-8">
        <h3 class="pb-4 mb-4 fst-italic border-bottom">
            Создать статью
        </h3>
        <form method="POST" action="{{ route('admin.news.store') }}">

            @csrf
            @include('news.fields', ['news' => new App\News()])

            <button type="submit" class="btn btn-primary">Сохранить новость</button>
        </form>
    </div>
@endsection
