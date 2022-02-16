<h3>Изменения:</h3>
@forelse($article->history as $item)
    <p>Изменил {{ $item->name }}  ({{ $item->email }}) - {{ $item->pivot->created_at->diffForHumans() }}
        <br>
        Before:
            <br>
            {{
                implode(', ', array_map(
                        function ($value, $key) {
                            return sprintf("%s: %s", $key, $value);
                        },
                        $item->pivot->old_value,
                        array_keys($item->pivot->old_value)
                    )
                )
            }}
        <br>
        After:
            <br>
            @forelse($item->pivot->new_value as $key => $value)
                {{ $key }}: {{ $value }},
            @empty
            @endforelse
    </p>
@empty
    <p>Нет изменений статьи</p>
@endforelse
