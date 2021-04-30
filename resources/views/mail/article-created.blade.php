@component('mail::message')
# Создана новая статья: {{ $article->title }}

{{ $article->description }}

@component('mail::button', ['url' => route('articles.show', $article)])
Посмотреть
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
