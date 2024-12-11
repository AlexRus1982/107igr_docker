@php
    // logger(json_encode($paginator, JSON_UNESCAPED_UNICODE));
@endphp

@if ($paginator->hasPages())
    <div class="paginator-container">
        <div class="paginator-wrapper">
            @if ($paginator->hasMorePages())
                <a 
                    class="show-more-button page-link w-100 p-2 rounded-2 bg-primary text-white my-2 d-flex justify-content-center" 
                    href="{{ $paginator->nextPageUrl() }}" 
                    rel="next"
                >
                    Показать ещё
                </a>
            @endif

            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center w-100" style="flex-wrap: wrap;">
                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1"><</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->previousPageUrl() }}"><</a>
                        </li>
                    @endif
        
                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <li class="page-item disabled px-3">{{ $element }}</li>
                        @endif
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item active">
                                        <a class="page-link">{{ $page }}</a>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
        
                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">></a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <a class="page-link" href="#">></a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
@endif

