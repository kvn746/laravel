@extends('layout.master')

@section('content')
    <div class="col-md-8">
        <h3 class="pb-4 mb-4 fst-italic border-bottom">
            Обратная связь
        </h3>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Email</th>
                <th scope="col">Сообщение</th>
                <th scope="col">Дата</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 0 ?>
            @foreach($messages as $message)
                <?php $i++ ?>
                <tr>
                    <th scope="row">{{ $i }}</th>
                    <td>{{ $message->email }}</td>
                    <td>{{ $message->message }}</td>
                    <td>{{ $message->created_at->toFormattedDateString() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
