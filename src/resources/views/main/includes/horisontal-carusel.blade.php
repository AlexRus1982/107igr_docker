{{-- 
    need on enter 
    itemsList, 
    listTitle, 
    listTitleUrl, 
    rootUrl 
--}}
@php
    if (!isset($showMore)) {
        $showMore = false;
    }
    $hasItems = count((array)$itemsList) > 0;

    $is_selfPage = isset($selfPage) ? true : false;
@endphp

@if ($hasItems )
    <div class="list-container">
        <div class="list-wrapper">
            <div class="horisontal-scroller-title-wrapper w-100">
                @if ($is_selfPage)
                    <h2 class="list-title">{{ $listTitle }}</h2>
                @else
                    <h2><a href="{{ $listTitleUrl }}" class="list-title">{{ $listTitle }}</a></h2>
                @endif
                <img src="/images/horizontal-scroll.png" alt="slider-help">
            </div>
            <div 
                class="list horisontal-scroller-container"
                onmousedown="$emit('horisontal-scroller-mouse-down', this)"
                onmouseup="$emit('horisontal-scroller-mouse-up', this)"
                onmousemove="$emit('horisontal-scroller-mouse-over', this)"
                onmouseleave="$emit('horisontal-scroller-mouse-out')"
            >
                @foreach ($itemsList as $item)
                    <a 
                        href="{{ $rootUrl }}/{{ $item->url }}" 
                        class="horisontal-scroller-element"
                        onclick="$emit('horisontal-scroller-element-click')"
                        onmouseup="$emit('horisontal-scroller-element-up', this)"
                        draggable="false"
                    >
                        <div> 
                            <div class="list-item-image">
                                <img 
                                    src="{{ $item->icon }}" 
                                    alt="{{ $item->name }} - аватарка" 
                                    loading="lazy"
                                    draggable="false"
                                >
                                <span>{{ $item->size }}</span>
                            </div>
                            <h3 class="list-item-title" draggable="false">
                                {{ $item->name }}
                            </h3>
                        </div>
                    </a>
                @endforeach

                @if ($showMore == true)
                    <a 
                        href="{{ $listTitleUrl }}" 
                        class="horisontal-scroller-element"
                        onclick="$emit('horisontal-scroller-element-click')"
                        onmouseup="$emit('horisontal-scroller-element-up', this)"
                        draggable="false"
                    >
                        <div> 
                            <div class="list-item-image">
                                <img 
                                    src="/images/pngwing.com.png" 
                                    alt="Посмотреть все" 
                                    loading="lazy"
                                    draggable="false"
                                >
                            </div>
                            <h3 class="list-item-title" draggable="false">
                                Посмотреть все
                            </h3>
                        </div>
                    </a>
                @endif
            </div>
        </div>
    </div>
@endif