@component('mail::message')
# Статистика блога:

@forelse($reports as $report)
    <ul>
        <li>
            {{ $report->title }}{{ $report->value }}
        </li>
    </ul>
@else
    Не выбран ни один отчет!
@endforelse

С наилучшими пожеланиями,<br>
{{ config('app.name') }}
@endcomponent
