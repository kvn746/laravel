@extends('admin.master')

@section('title', 'Отчеты')

@section('content')
    <reports></reports>
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
        @admin
            <hr>
            <h6 class="pb-4 mb-4 fst-italic border-bottom">
                Статистика блога
            </h6>

            <table class="table table-striped" id="statistic">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Отчет</th>
                    <th scope="col">Выбрать</th>
                    <th scope="col">Комментарий</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Статьи</td>
                        <td>
                            <input type="checkbox" name="Article" checked>
                        </td>
                        <td>Общее количество статей</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Новости</td>
                        <td>
                            <input type="checkbox" name="News" checked>
                        </td>
                        <td>Общее количество новостей</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Комментарии</td>
                        <td>
                            <input type="checkbox" name="Comment" checked>
                        </td>
                        <td>Общее количество комментариев</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Теги</td>
                        <td>
                            <input type="checkbox" name="Tag" checked>
                        </td>
                        <td>Общее количество тегов</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Пользователи</td>
                        <td>
                            <input type="checkbox" name="User" checked>
                        </td>
                        <td>Общее количество пользователей</td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary" onclick="generate('{{ route('statistics') }}', '{{ csrf_token() }}')">Создать отчет</button>
        @endadmin
        <nav class="blog-pagination" aria-label="Pagination">
{{--            {{ $news->links() }}--}}
{{--            <a class="btn btn-outline-primary" href="#">Newer</a>--}}
{{--            <a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Older</a>--}}
        </nav>

    </div>

@endsection

<script type="text/javascript">
    function generate(url, csrf)
    {
        inputs = document.getElementById('statistic').getElementsByTagName('input');
        statistic = [];
        for (i = 0; i < inputs.length; i++) {
            if (inputs[i].checked) {
                statistic.push(inputs[i].name);
            }
        }

        $.ajax({
            type: "POST",
            url: url,
            data: {
                _token: csrf,
                statistic: statistic,
            },
            dataType: 'html',
            success: function (data) {
                //location.reload();
            }
        });
    }
</script>

{{--<script src="{{ asset('/js/report.js') }}"></script>--}}
