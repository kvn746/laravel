@component('mail::message')
# Новые статьи за период {{ $period }}

@component('mail::panel')
@if($articles->count())
@foreach($articles as $article)
<ul>
<li>
<div>

[{{ $article->title }}]({{ route('articles.show', $article) }})

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

@component('mail::button', ['url' => route('articles.index')])
    Перейти к статьям
@endcomponent

@endcomponent
