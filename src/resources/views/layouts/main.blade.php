<!doctype html>

@php
    //$sessionId = session()->get('_token');
    //echo ActionsSystem::Action('Test');
    //EventsSystem::Event('TestEvent');
    $routeName      = Route::currentRouteName();
    $title          = "Игры и приложения на андроид на 107 IGR | Скачать софт на русском языке";
    $description    = "Каталог бесплатного софта. Программы для компьютеров и смартфонов. Скачивать программы на  107 IGR  безопасно, бесплатно и удобно.";
    $favIconPath    = "/images/favicon.ico";
    $twitterImage    = "https://107igr.ru/images/favicon.png";

    switch ($routeName) {
        case 'main.page'            :
            $title                  = "Игры и приложения на андроид на 107 IGR | Скачать софт на русском языке";
            $description            = "Каталог бесплатного софта. Программы для компьютеров и смартфонов. Скачивать программы на  107 IGR  безопасно, бесплатно и удобно.";
            break;
        
        case 'games.page'           :
            $title                  = "Игры для андроид скачать | Огромный выбор бесплатных игр на 107 IGR.RU";
            $description            = "Скачать игры для Андроид. Качайте игры для Android телефонов и планшетов бесплатно. Полные версии игры.";
            break;

        case 'games.page.url'       :
            if (isset($page?->app)) {
                $appName            = $page?->app?->name;
                $title              = "{$appName} скачать на андроид бесплатно | На русском языке, последняя версия  | 107 IGR.RU";
                $description        = "Скачать {$appName} на телефон андроид | Игра {$appName} на русском языке, последняя версия | Официальный сайт разработчика";
                $twitterImage       = $page?->app?->icon;
            } else {
                $category           = $page?->category?->category;
                $title              = "{$category} скачать для андроид | На русском языке бесплатно | 107 IGR.RU";
                $description        = "Скачать игры {$category} на Android бесплатно на русском языке | Без регистрации, прямая ссылка, без торрентов и SMS | {$category} для андроид для телефонов и планшетов.";
            }

            break;

        case 'apps.page'            :
            $title                  = "Приложения для андроид скачать | Огромный выбор бесплатных приложений на 107 IGR.RU";
            $description            = "Скачать приложения для Андроид. Качайте приложения для Android телефонов и планшетов бесплатно. Полные версии приложения.";
            break;

        case 'apps.page.url'        :
            if (isset($page?->app)) {
                $appName            = $page?->app?->name;
                $title              = "{$appName} скачать на андроид бесплатно | На русском языке, последняя версия  | 107 IGR.RU";
                $description        = "Скачать {$appName} на телефон андроид | Приложение {$appName} на русском языке, последняя версия | Официальный сайт разработчика";
                $twitterImage       = $page?->app?->icon;
            } else {
                $category           = $page?->category?->category;
                $title              = "{$category} скачать для андроид | На русском языке бесплатно | 107 IGR.RU";
                $description        = "Скачать приложения {$category} на Android бесплатно на русском языке | Без регистрации, прямая ссылка, без торрентов и SMS | {$category} для андроид для телефонов и планшетов.";
            }
            break;

        case 'download.page.url'    :
            $appName                = $page?->app?->name;
            $title                  = "{$appName} скачать на андроид.";
            $description            = "{$appName} 107IGR.RU - крупнейший в рунете каталог игр, программ и приложений.";
            $twitterImage           = $page?->app?->icon;
            break;

        default                     :
            $title                  = "Игры и приложения на андроид на 107 IGR | Скачать софт на русском языке";
            $description            = "Каталог бесплатного софта. Программы для компьютеров и смартфонов. Скачивать программы на  107 IGR  безопасно, бесплатно и удобно.";
            $twitterImage           = "https://107igr.ru/images/favicon.png";
            break;
    }
@endphp

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- SEO --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://107igr.ru/">

    <meta name="description" content="{{ $description }}">
    <meta itemprop="description" content="{{ $description }}">
    <meta property="og:description" content="{{ $description }}">
    

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:image" content="{{ $twitterImage }}" />

    <meta property="og:title" content="{{ $title }}">
    <meta property="vk:image" content="{{ $favIconPath }}"/>
    <meta property="og:image" content="{{ $favIconPath }}">
    <link rel="icon" href="{{ $favIconPath }}" type="image/x-icon">
    <meta property="og:image:secure_url" content="{{ $favIconPath }}">

    @if (!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Lighthouse') === false)
        <!-- Yandex.Metrika counter -->
        <meta name="yandex-verification" content="fbeaaef947c3da24" />
        <script type="text/javascript" >
            (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();
            for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
            k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
            (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
        
            ym(88235080, "init", {
                clickmap:true,
                trackLinks:true,
                accurateTrackBounce:true,
                webvisor:true
            });
        </script>
        <noscript><div><img src="https://mc.yandex.ru/watch/88235080" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
        <!-- /Yandex.Metrika counter -->

        <!-- Yandex.RTB -->
        <script>window.yaContextCb=window.yaContextCb||[]</script>
        <script src="https://yandex.ru/ads/system/context.js" async></script>
        <!-- /Yandex.RTB -->
    @endif

    <meta name="google-site-verification" content="MJljaOv_6-oM4pZGQdaqRNhfZXjBinKw36j75gYT514" />    
    
    <title>{{ $title }}</title>

    {{-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> --}}

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> --}}
    
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/bootstrap.bundle.min.js"></script>
    
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> --}}

    @vite(['resources/sass/main/main.scss'])

    <script async src="https://widget.sparrow.ru/js/embed.js"></script>

</head>
    <body>
        <a name="top"></a>
        <header>
            @include ('main.includes.header')
        </header>
        <main>
            @yield('main-section')
            
            <!-- Sparrow -->
            {{-- <div style="width: 100%; max-width: 1200px;">
                <script type="text/javascript" data-key="3ce5f13d5120f02e208889fa5253d898">
                    (function(w, a) {
                        (w[a] = w[a] || []).push({
                            'script_key': '3ce5f13d5120f02e208889fa5253d898',
                            'settings': {
                                'sid': 55123
                            }
                        });
                        if(window['_Sparrow_embed']){
                        window['_Sparrow_embed'].initWidgets();
                        } 
                    })(window, '_sparrow_widgets');
                </script>
            </div> --}}
            <!-- /Sparrow -->
        </main>
        <footer>
            @include ('main.includes.footer')
        </footer>
    </body>

    @yield('js-section')
</html>
