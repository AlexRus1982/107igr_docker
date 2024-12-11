@extends('layouts.main')

@section('main-section')
    <div class="line-margin mt-4"></div>
    
    @include ('main.includes.horisontal-carusel', [
        'itemsList'             => $page->PopularGames,
        'listTitle'             => 'Популярные игры' ,
        'listTitleUrl'          => '/games',
        'rootUrl'               => '/games', 
    ])

    @include ('main.includes.horisontal-carusel', [
        'itemsList'             => $page->PopularApps,
        'listTitle'             => 'Популярные приложения' ,
        'listTitleUrl'          => '/apps',
        'rootUrl'               => '/apps',
    ])
    
    @include ('main.includes.yandex-block')

    @include ('main.includes.categories-list', [
        'categoriesList'        => $page->GamesCategories,
        'categoriesTitle'       => 'Игры',
        'categoriesTitleUrl'    => '/games',
    ])
    
    <div class="line-margin mt-4"></div>
    
    @include ('main.includes.categories-list', [
        'categoriesList'        => $page->AppsCategories,
        'categoriesTitle'       => 'Приложения',
        'categoriesTitleUrl'    => '/apps',
    ])

    <div class="line-margin mt-4"></div>

    {{-- @include ('main.includes.blogs-list', ['PopularBlogs' => $page->PopularBlogs]) --}}
    
    <div class="line-margin mt-4"></div>

    @include ('main.includes.vertical-apps-list', [
        'list'  => $page->PopularDownLoads,
        'title' => 'Самые скачиваемые',
    ])

    <div class="line-margin mt-4"></div>
    
    @include ('main.includes.horisontal-apps-list', [
        'list'  => $page->NewerApps,
        'title' => 'Новинки',
    ])

    <div class="line-margin mt-4"></div>

    @include ('main.includes.prefooter-text')
@endsection

@section('js-section')
    @vite(['resources/js/main/main.js'])
@endsection
