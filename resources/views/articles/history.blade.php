<h3>Изменения:</h3>
@forelse($article->history as $item)
    <p>Изменил {{ $item->name }}  ({{ $item->email }}) - {{ $item->pivot->created_at->diffForHumans() }} <br>Before:  {{ $item->pivot->old_value }} <br>After: {{ $item->pivot->new_value }}</p>
@empty
    <p>Нет изменений статьи</p>
@endforelse
