@component('mail::message')
# Статья удалена: {{ $title }}

@component('mail::button', ['url' => route('articles.index')])
К списку статей
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
