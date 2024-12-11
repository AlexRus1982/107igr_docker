{{-- need on enter list --}}
<div class="hamburger-menu-list-wrapper">
    <div class="hamburger-menu-list">
        @if (!Route::is('main.page'))
            <a href="/" class="hamburger-menu-list-item">
                Главная
            </a>
        @endif

        @foreach ($list as $item)
            {{-- @php
                $current = Route::is($item['route']) ? true : false;
            @endphp --}}
            {{-- @if (!$current) --}}
                <a href="{{ $item['url'] }}" class="hamburger-menu-list-item">
                    {{ $item['name'] }}
                </a>
            {{-- @endif --}}
        @endforeach
    </div>
</div>
