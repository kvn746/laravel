@extends('layout.master')

@section('title', 'Создать статью')

@section('content')
    <div class="col-md-8">
        <h3 class="pb-4 mb-4 fst-italic border-bottom">
            Создать статью
        </h3>
        <form method="POST" action="{{ Route('articles') }}">

            @csrf

            <div class="mb-3">
                <label for="article-title" class="form-label">Название статьи</label>
                <input type="text" class="form-control" id="article-title" name="title" value="{{ old('title') }}">
            </div>
            <div class="mb-3">
                <label for="article-description" class="form-label">Краткое описание статьи</label>
                <textarea class="form-control" name="description" id="article-description" rows="5">{{ old('description') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="article-text" class="form-label">Текст статьи</label>
                <textarea class="form-control" name="text" id="article-text" rows="5">{{ old('text') }}</textarea>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="is_public" name="is_public" <?= (bool) old('is_public') ? 'checked' : ''?> >
                <label class="form-check-label" for="is-public">Опубликовать</label>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить статью</button>
        </form>
    </div>
@endsection
