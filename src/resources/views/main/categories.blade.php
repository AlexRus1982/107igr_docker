{{-- main_url --}}
@extends('layouts.main')

@section('main-section')
    <div class="main-category-header">{{ $page->mainTitle }}</div>
    
    @include ('main.includes.horisontal-carusel', [
        'itemsList'             => $page->Popular,
        'listTitle'             => $page->PopularListTile,
        'listTitleUrl'          => $page->PopularlistTitleUrl,
        'rootUrl'               => $page->PopularRootUrl,
        'selfPage'              => true,
    ])

    @include ('main.includes.yandex-block')

    @foreach ($page->CategoriesList as $item)
        {{-- <div class="line-margin mt-2"></div> --}}
    
        @include ('main.includes.horisontal-carusel', [
            'itemsList'         => $item['category_list'],
            'listTitle'         => $item['category_name'],
            'listTitleUrl'      => "{$item['category_main_url']}/{$item['category_url']}",
            'rootUrl'           => "{$item['category_main_url']}", 
            'showMore'          => ($item['category_list_count'] > 10) ? true : false,
        ])
    @endforeach
@endsection

@section('js-section')
    @vite(['resources/js/main/main.js'])
@endsection
