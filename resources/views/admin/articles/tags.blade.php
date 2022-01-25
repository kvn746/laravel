@php
    $tags = $tags ?? collect();
@endphp

@if($tags->isNotEmpty())
    <hr>
    <div>
        @foreach($tags as $tag)
            <a href="{{ route('admin.articles.tags', ['tag' => $tag]) }}" class="badge bg-secondary text-white text-decoration-none">{{ $tag->name }}</a>
        @endforeach
    </div>
    <hr>
@endif

