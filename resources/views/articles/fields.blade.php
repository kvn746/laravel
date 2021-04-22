<div class="mb-3">
    <label for="article-title" class="form-label">Название статьи</label>
    <input type="text" class="form-control" id="article-title" name="title" value="{{ old('title', $article->title) }}">
</div>
<div class="mb-3">
    <label for="article-description" class="form-label">Краткое описание статьи</label>
    <textarea class="form-control" name="description" id="article-description" rows="5">{{ old('description', $article->description) }}</textarea>
</div>
<div class="mb-3">
    <label for="article-text" class="form-label">Текст статьи</label>
    <textarea class="form-control" name="text" id="article-text" rows="5">{{ old('text', $article->text) }}</textarea>
</div>
<div class="mb-3">
    <label for="inputTags">Теги</label>
    <input type="text"
           name="tags"
           class="form-control"
           id="inputTags"
           value="{{ old('tags', $article->tags->pluck('name')->implode(',')) }}"
    >
</div>
<div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="is_public" name="is_public" <?= old('is_public') || (bool) $article->is_public ? 'checked' : ''?> >
    <label class="form-check-label" for="is-public">Опубликовать</label>
</div>
