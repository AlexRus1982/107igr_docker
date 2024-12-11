@php
    // logger(json_encode($page->SearchingResult, JSON_UNESCAPED_UNICODE));
@endphp

@extends('layouts.main')

@section('main-section')
    {{-- <div class="line-margin mt-4"></div> --}}
    
    {{-- @include ('main.includes.horisontal-carusel', [
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
    ]) --}}
    
    {{-- @include ('main.includes.yandex-block') --}}

    <div class="line-margin mt-4"></div>

    {{-- @include ('main.includes.blogs-list', ['PopularBlogs' => $page->PopularBlogs]) --}}
    
    {{-- <div class="line-margin mt-4"></div> --}}

    @include ('main.includes.vertical-apps-list', [
        'list'  => $page->SearchingResult->toArray()['data'],
        'title' => 'Результаты поиска',
    ])

    <div class='searching-result-pagination'>
        {!! $page->SearchingResult->appends(['searchParam' => $page->SearchParam])->links() !!}
    </div>

    <div class="line-margin mt-4"></div>
    
    {{-- @include ('main.includes.horisontal-apps-list', [
        'list'  => $page->NewerApps,
        'title' => 'Новинки',
    ]) --}}
    @include ('main.includes.yandex-block')

    <div class="line-margin mt-4"></div>

    @include ('main.includes.prefooter-text')
@endsection

@section('js-section')
    @vite(['resources/js/main/main.js'])
@endsection
