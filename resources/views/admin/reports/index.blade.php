@extends('admin.master')

@section('title', 'Отчеты')

@section('content')
    <div class="col-md-8">
        <h3 class="pb-4 mb-4 fst-italic border-bottom">
            Отчеты
        </h3>

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Отчет</th>
                <th scope="col">Значение</th>
                <th scope="col">Комментарий</th>
            </tr>
            </thead>
            <tbody>
            @php
                $i = 1;
            @endphp
            @foreach($reports as $report)
                <tr>
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $report['name'] }}</td>
                    <td>{{ $report['value'] }}</td>
                    @if(! is_string($report['comment']))
                        <td><a href="{{ route('admin.articles.show', $report['comment']->slug ?? '') }}">{{ $report['comment']->title ?? '' }}</a></td>
                    @else
                        <td>{{ $report['comment'] }}</td>
                    @endif
            @endforeach
            </tbody>
        </table>

        <nav class="blog-pagination" aria-label="Pagination">
{{--            {{ $news->links() }}--}}
{{--            <a class="btn btn-outline-primary" href="#">Newer</a>--}}
{{--            <a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Older</a>--}}
        </nav>

    </div>
@endsection
