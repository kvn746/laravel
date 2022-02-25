<h3>Комментарии:</h3>
@forelse($news->comment as $item)
    <p>{{ $item->user->name }}  ({{ $item->user->email }}) - {{ $item->created_at->diffForHumans() }} <br> {{ $item->text }}</p>
@empty
    <p>Нет комментариев</p>
@endforelse
@auth
<form method="POST" action="{{ route('comment.news.store') }}">
    @csrf
    <div class="mb-3">
        <label for="comment-text" class="form-label">Добавить комментарий</label>
        <textarea class="form-control" name="text" id="comment-text" rows="3">{{ old('text') }}</textarea>
    </div>
    <input type="hidden" name="commentable_id" value="{{ $news->id }}">
    <input type="hidden" name="commentable_type" value="{{ get_class($news) }}">
    <button type="submit" class="btn btn-primary">Добавить</button>
</form>
@endauth
<hr>
