@php
    $tags = $tags ?? collect();
@endphp

<hr>
@if($tags->isNotEmpty())
    <div>
        @foreach($tags as $tag)
            <a href="{{ route('articles.tags', ['tag' => $tag]) }}" class="badge bg-secondary text-white text-decoration-none">{{ $tag->name }}</a>
        @endforeach
    </div>
@endif
<hr>
