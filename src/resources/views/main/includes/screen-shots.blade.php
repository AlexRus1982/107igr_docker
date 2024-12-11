{{-- need on enter list, title --}}

@php
    $hasItems = count((array)$list) > 0;
    $newlist = [];
    foreach ($list as $item) {
        $newList[] = (substr($item, 0, 1) !='/') ? '/' . $item : $item;
    }
@endphp
@if ($hasItems)
    <div class="screen-shoot-list">
        <div class="list-wrapper">
            <div class="horisontal-scroller-title-wrapper w-100">
                <h2 class="list-title">{{ $title }}</h2>
                <img src="/images/horizontal-scroll.png" alt="slider-help">
            </div>
            <div 
                class="list horisontal-scroller-container"
                onmousedown="$emit('horisontal-scroller-mouse-down', this)"
                onmouseup="$emit('horisontal-scroller-mouse-up', this)"
                onmousemove="$emit('horisontal-scroller-mouse-over', this)"
                onmouseleave="$emit('horisontal-scroller-mouse-out')"
            >
                @foreach ($newList as $item)
                    <div 
                        class="horisontal-scroller-element"
                        onclick="$emit('horisontal-scroller-element-click')"
                        onmouseup="$emit('horisontal-scroller-element-up', this)"
                        draggable="false"
                    >
                        <img 
                            src="{{ $item }}" 
                            alt="Скриншот №{{ $loop->index + 1 }}" 
                            loading="lazy"
                            draggable="false"
                        >
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
