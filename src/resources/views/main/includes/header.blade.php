<div class="main-header-container">
    {{-- Hamburger menu --}}
    <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasHamburgerMenu" aria-labelledby="offcanvasHamburgerMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasHamburgerMenuLabel">Меню</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            @include ('main.includes.hamburger-menu-list', [
                'list'  => config('globals.MenuItems'),
            ])
        </div>
    </div>

    {{-- Hamburger menu button --}}
    <div class="header-burger" data-bs-toggle="offcanvas" data-bs-target="#offcanvasHamburgerMenu" aria-controls="offcanvasHamburgerMenu">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
        </svg>
    </div>
    
    {{-- edit app --}}
    @if(Auth::check() && isset($page?->app) && Route::currentRouteName() != 'download.page.url')
        {{-- <div class="edit-if-admin" title="Редактировать" onclick="$emit('edit-if-admin-clicked', {{ $page->app->id }})">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
            </svg>
        </div> --}}
        <a class="edit-if-admin" title="Редактировать" target="_blank" href="/admin-panel/apps/edit?id={{ $page->app->id }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
            </svg>
        </a>
    @endif

    {{-- edit page --}}
    @if(Auth::check() && isset($page?->id) && str_contains(Route::currentRouteName(), '.info.page'))
        <a class="edit-if-admin" title="Редактировать" target="_blank" href="/admin-panel/page/edit?id={{ $page->id }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
            </svg>
        </a>
    @endif    

    {{-- Logo --}}
    <div class="header__logo__text">
        @php
            $active = Route::is('main.page') ? true : false;
        @endphp
        @if ($active)
            <div class="header__logo active"><img src="/images/107 LOGO.svg"></div>
        @else
            <a href="/" class="header__logo"><img src="/images/107 LOGO.svg"></a>
        @endif
    </div>

    @php
        $headersItems = config('globals.MenuItems');
        $headersItemsCurrent = false;
    @endphp
    
    @if (Route::is('main.page'))
        <div class="mobile-header-active-text"><a href="/"><img src="/images/107 LOGO.svg"></a></div>
        @php
            $headersItemsCurrent = true;
        @endphp
    @endif

    @foreach ($headersItems as $headerItem)
        @if (!Route::is('main.page') && Route::is($headerItem['route']))
            @php
                $headersItemsCurrent = true;
            @endphp
            {{-- <div class="mobile-header-active-text"><a href="/">107 ИГР</a>&nbsp- {{ $headerItem['name'] }}</div> --}}
            <div class="mobile-header-active-text"><a href="/"><img src="/images/107 LOGO.svg"></a></div>
        @endif
    @endforeach

    @if (!$headersItemsCurrent)
        {{-- <div class="mobile-header-active-text"><a href="/">107 ИГР</a>&nbsp- @yield('header-section')</div> --}}
        <div class="mobile-header-active-text"><a href="/"><img src="/images/107 LOGO.svg"></a></div>
    @endif


    {{-- Center menu --}}
    <div class="header-center">
        
        @foreach ($headersItems as $headerItem)
            @php
                $active = Route::is($headerItem['route']) ? true : false;
            @endphp
            @if ($active)
                <div class="headerItem active">{{ $headerItem['name'] }}</div>
            @else
                <a href="{{ $headerItem['url'] }}" class="headerItem">{{ $headerItem['name'] }}</a>
            @endif
        @endforeach
        
        <div class="wrap__active">
            <input type="text" class="input__active" placeholder="Найти на 107 игр" oninput="$emit('search_desc_input', this)">
            <div class="search_desc_button hide" title="Начать поиск" onclick="$emit('search-button-click', this)">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
            </div>
            <div class="searchResults searchResults__desctop"></div>
        </div>
    </div>

    {{-- Searcher  --}}
    <div class="header-sercher" onclick="$emit('header-sercher-click')">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
        </svg>
    </div>
</div>

<div class="searcher-header-container">
    <div class="seracher_wrapper">
        <input type="text" class="input__active" oninput="$emit('search_mobile_input', this)" placeholder="Найти на 107 игр">
        <div class="search_mobile_button hide" title="Начать поиск" onclick="$emit('search-button-click', this)">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
        </div>
    </div>
</div>

<div class="searcher-header-results">
    <div class="searcher-header-results-loading">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
            <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
            <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
        </svg>
    </div>
    <div class="searcher-header-results-list">
        1245<br>
        234234<br>
        455<br>
        234234<br>
        455<br>
        1245<br>
        234234<br>
        455<br>
        234234<br>
        455<br>
    </div>
</div>