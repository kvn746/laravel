@component('mail::message')
# Статистика блога:

@component('mail::panel')
@forelse($reports as $report)
<ul>
<li>
<div>
{{ $report['title'] }}{{ $report['value'] }}
</div>
</li>
</ul>
@empty
    Не выбран ни один отчет!
@endforelse
@endcomponent

С наилучшими пожеланиями,<br>
{{ config('app.name') }}
@endcomponent
