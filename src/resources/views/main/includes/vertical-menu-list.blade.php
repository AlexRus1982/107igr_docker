{{-- need on enter list, title --}}

@php
    $hasItems = count((array)$list) > 0;
@endphp

@if ($hasItems)
    <div class="vertical-menu-list-wrapper">
        <div class="vertical-menu-title">{{ $title }}</div>
        <div class="vertical-menu-list">
            @if (!Route::is('main.page') && $title == 'Меню')
                <a href="/" class="vertical-menu-list-item">
                    Главная
                </a>
            @endif
            @foreach ($list as $item)
                {{-- @php
                    $current = Route::is($item['route']) ? true : false;
                @endphp
                @if (!$current)
                    <a href="{{ $item['url'] }}" class="vertical-menu-list-item">
                        {{ $item['name'] }}
                    </a>
                @endif --}}
                <a href="/{{ $item['url'] }}" class="vertical-menu-list-item">
                    {{ $item['name'] }}
                </a>
            @endforeach
        </div>
    </div>
@endif
