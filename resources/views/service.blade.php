@extends('layout.without_sidebar')

@section('title', 'Отправить уведомление')

@section('content')
    <div class="col-md-8">
        <h3 class="pb-4 mb-4 fst-italic border-bottom">
            Отправить уведомление
        </h3>
        <form method="POST" action="{{ route('service.send') }}">

            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Заголовок сообщения</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
            </div>
            <div class="mb-3">
                <label for="text" class="form-label">Текст сообщения</label>
                <textarea class="form-control" name="text" id="text" rows="5">{{ old('text') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Отправить сообщение</button>
        </form>
    </div>
@endsection
