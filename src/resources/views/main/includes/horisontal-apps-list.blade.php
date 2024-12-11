{{-- 
    need on enter 
    list, 
    title, 
--}}
@php
    $hasItems = count((array)$list) > 0;
@endphp

@if ($hasItems)
    <div class="horisontal-apps-list-container">
        <div class="horisontal-apps-list-wrapper">
            <div class="horisontal-scroller-title-wrapper w-100">
                <h2 class="horisontal-apps-list-title">{{ $title }}</h2>
                <img src="/images/horizontal-scroll.png" alt="slider-help">
            </div>
            <div 
                class="horisontal-apps-list py-2 horisontal-scroller-container"
                onmousedown="$emit('horisontal-scroller-mouse-down', this)"
                onmouseup="$emit('horisontal-scroller-mouse-up', this)"
                onmousemove="$emit('horisontal-scroller-mouse-over', this)"
                onmouseleave="$emit('horisontal-scroller-mouse-out')"
            >
                @foreach ($list as $item)
                    <a 
                        href="/{{ $item->main_url }}/{{ $item->url }}"
                        class="horisontal-scroller-element"
                        onclick="$emit('horisontal-scroller-element-click')"
                        onmouseup="$emit('horisontal-scroller-element-up', this)"
                        draggable="false"
                    >
                        <div> 
                            <div class="image-wrapper">
                                <img 
                                    src="https://files.107igr.ru{{ $item->icon }}" 
                                    alt="{{ $item->name }} - аватарка" 
                                    loading="lazy"
                                    draggable="false"
                                >
                            </div>
                            <h3 class="horisontal-apps-list-item-title" draggable="false">
                                {{ $item->name }}
                            </h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endif