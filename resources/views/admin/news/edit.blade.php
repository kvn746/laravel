@extends('admin.master')

@section('title', 'Редактировать новость')

@section('content')
    <div class="col-md-8">
        <h3 class="pb-4 mb-4 fst-italic border-bottom">
            Изменить статью
        </h3>
        <form method="POST" action="{{ route('admin.news.update', ['news' => $news]) }}">

            @csrf
            @method("PATCH")
            @include('news.fields')

            <button type="submit" class="btn btn-primary">Изменить новость</button>
        </form>
        <form method="POST" action="{{ route('admin.news.destroy', ['news' => $news]) }}">

            @csrf
            @method("DELETE")

            <button type="submit" class="btn btn-danger">Удалить новость</button>
        </form>
        <div class="border-top">
            <a  href="{{ route('admin.news.index') }}">К списку новостей</a>
        </div>
    </div>
@endsection
