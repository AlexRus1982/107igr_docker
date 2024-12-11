@php
    $hasItems = count((array)$PopularBlogs) > 0;
@endphp

@if ($hasItems)
    <div class="blogs-list-wrapper">
        <div class="blogs-list-title-wrapper">
            <a href="/blogs" class="blogs-list-title">Блог</a>
        </div>

        <div class="blogs-list">
            @foreach ($PopularBlogs as $blog)
                <a href="/blogs/{{ $blog['url'] }}">
                    <img class="blog-image" src="https://107igr.ru/{{ $blog['image'] }}" alt="Блог - {{ $blog['title'] }}">
                    <div class="blog-title">{{ $blog['title'] }}</div>
                </a>
            @endforeach
        </div>
    </div>
@endif
