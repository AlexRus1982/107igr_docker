{{-- need on enter list, title --}}

@php
    $hasItems = count((array)$list) > 0;
@endphp
@if ($hasItems)
    <div class="vertical-apps-list-wrapper">
        <div class="vertical-apps-list-container">
            <h2 class="vertical-apps-title">{{ $title }}</h2>
            <div class="vertical-apps-list">
                @foreach ($list as $item)
                    @php
                        $item = (array) $item;
                    @endphp
                    <div class="vertical-apps-list-item">
                        <a class="image-wrapper" href="/{{ $item['main_url'] }}/{{ $item['url'] }}">
                            <img src="https://files.107igr.ru{{ $item['icon'] }}" alt="{{ $item['main_url'] }} - {{ $item['name'] }}">
                        </a>
                        <div class="right-side">
                            <a class="app-name" href="/{{ $item['main_url'] }}/{{ $item['url'] }}">{{ $item['name'] }}</a>

                            <a class="app-category" href="/{{ $item['main_url'] }}">{{ $item['mainCategory'] }}</a>
                            {{-- <a href="/download/{{ $item['url'] }}" class="app-download-button">Скачать</a> --}}
                            <a href="/{{ $item['main_url'] }}/{{ $item['url'] }}" class="app-download-button">Скачать</a>
                        </div>
                    </div>

                    @if (isset($yandex) && $loop->index == 1)
                        <div class="vertical-apps-list-item">
                            @include ('main.includes.yandex-block')
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endif
