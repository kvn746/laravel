<div class="mb-3">
    <label for="news-title" class="form-label">Название новости</label>
    <input type="text" class="form-control" id="news-title" name="title" value="{{ old('title', $news->title) }}">
</div>
<div class="mb-3">
    <label for="news-description" class="form-label">Краткое описание новости</label>
    <textarea class="form-control" name="description" id="news-description" rows="5">{{ old('description', $news->description) }}</textarea>
</div>
<div class="mb-3">
    <label for="news-text" class="form-label">Текст новости</label>
    <textarea class="form-control" name="text" id="news-text" rows="5">{{ old('text', $news->text) }}</textarea>
</div>
{{--<div class="mb-3">--}}
{{--    <label for="inputTags">Теги</label>--}}
{{--    <input type="text"--}}
{{--           name="tags"--}}
{{--           class="form-control"--}}
{{--           id="inputTags"--}}
{{--           value="{{ old('tags', $news->tags->pluck('name')->implode(',')) }}"--}}
{{--    >--}}
{{--</div>--}}
@editor
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="is_public" name="is_public" <?= old('is_public') || (bool) $news->is_public ? 'checked' : ''?> >
        <label class="form-check-label" for="is-public">Опубликовать</label>
    </div>
@endeditor
