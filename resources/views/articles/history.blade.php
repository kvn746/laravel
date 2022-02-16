<h3>Изменения:</h3>
@forelse($article->history as $item)
{{--    <p>Изменил {{ $item->name }}  ({{ $item->email }}) - {{ $item->pivot->created_at->diffForHumans() }} <br>Before:  {{ $item->pivot->old_value }} <br>After: {{ $item->pivot->new_value }}</p>--}}
    <p>Изменил {{ $item->user->name }}  ({{ $item->user->email }}) - {{ $item->created_at->diffForHumans() }}
        <br>
        Before:
            <br>
            {{
                implode(', ', array_map(
                        function ($value, $key) {
                            return sprintf("%s: %s", $key, $value);
                        },
                        $item->old_value,
                        array_keys($item->old_value)
                    )
                )
            }}
        <br>
        After:
            <br>
            @forelse($item->new_value as $key => $value)
                {{ $key }}: {{ $value }},
            @empty
            @endforelse
    </p>
@empty
    <p>Нет изменений статьи</p>
@endforelse
