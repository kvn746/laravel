<aside class="col-md-4 blog-sidebar">
    <div class="p-4 mb-3 bg-light rounded">
        <h4 class="fst-italic">Теги</h4>
        @include('admin.tags', ['tags' => $tagsCloud])
        <a class="text-secondary text-decoration-none" href="{{ route('admin.articles.index') }}">Показать все статьи</a>
        <br>
        <a class="text-secondary text-decoration-none" href="{{ route('admin.news.index') }}">Показать все новости</a>
    </div>
</aside>
