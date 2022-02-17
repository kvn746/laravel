<h3>Комментарии:</h3>
@forelse($article->comment as $item)
    <p>{{ $item->name }}  ({{ $item->email }}) - {{ $item->pivot->created_at->diffForHumans() }} <br> {{ $item->pivot->text }}</p>
@empty
    <p>Нет комментариев</p>
@endforelse
@auth
<form method="POST" action="{{ route('comment.store') }}">
    @csrf
    <div class="mb-3">
        <label for="comment-text" class="form-label">Добавить комментарий</label>
        <textarea class="form-control" name="text" id="comment-text" rows="3">{{ old('text') }}</textarea>
    </div>
    <input type="hidden" name="article_id" value="{{ $article->id }}">
    <button type="submit" class="btn btn-primary">Добавить</button>
</form>
@endauth
<hr>
