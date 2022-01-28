@component('mail::message')
# Новые статьи за период {{ $period }}

@component('mail::panel')
    @if($articles->count())
        @foreach($articles as $article)
            <ul>
                <li>
                    <div>
                        <a target="_blank" href="/articles/{{ $article->slug }} ">{{ $article->title }} </a>
                    </div>
                    <div>
                        {{ $article->description }}
                    </div>
                </li>
            </ul>
        @endforeach
    @else
        Нет новых статей
    @endif
@endcomponent

@component('mail::button', ['url' => '/articles/'])
    Перейти к статьям
@endcomponent

@endcomponent
