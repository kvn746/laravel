@extends('layout.master')

@section('title', 'Контакты')

@section('content')
    <div class="col-md-8">
        <h3 class="pb-4 mb-4 fst-italic border-bottom">
            Контакты
        </h3>
        <form method="POST" action="{{ route('contacts.store') }}">

            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email адрес</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Текст сообщения</label>
                <textarea class="form-control" name="message" id="message" rows="5"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>
@endsection
