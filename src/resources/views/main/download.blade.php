@php
    // logger(json_encode($page));
@endphp

@extends('layouts.main')

@section('header-section')
    Загрузка - {{ $page->app->name }}
@endsection

@section('main-section')
    {{-- Хлебные крошки --}}
    <div class="bread-crumps-wrapper">
        <div class="bread-crumps">
            <a href="/" class="home_link">
                <svg 
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    id="Capa_1"
                    x="0px" y="0px"
                    width="36px" height="20px"
                    viewBox="0 0 486.988 486.988"
                    style="enable-background:new 0 0 486.988 486.988;"
                    xml:space="preserve"
                >
                    <path d="M16.822,284.968h39.667v158.667c0,9.35,7.65,17,17,17h116.167c9.35,0,17-7.65,17-17V327.468h70.833v116.167 c0,9.35,7.65,17,17,17h110.5c9.35,0,17-7.65,17-17V284.968h48.167c6.8,0,13.033-4.25,15.583-10.483 c2.55-6.233,1.133-13.6-3.683-18.417L260.489,31.385c-6.517-6.517-17.283-6.8-23.8-0.283L5.206,255.785 c-5.1,4.817-6.517,12.183-3.967,18.7C3.789,281.001,10.022,284.968,16.822,284.968z M248.022,67.368l181.333,183.6h-24.367 c-9.35,0-17,7.65-17,17v158.667h-76.5V310.468c0-9.35-7.65-17-17-17H189.656c-9.35,0-17,7.65-17,17v116.167H90.489V267.968 c0-9.35-7.65-17-17-17H58.756L248.022,67.368z">
                    </path>
                </svg>
            </a>

            <a href="/{{ $page->category->main_url }}" class="category_link">{{ $page->category->mainCategory }}</a>
            <span class="link_arrow">
                <svg 
                    xmlns="http://www.w3.org/2000/svg" 
                    width="16" height="15" 
                    viewBox="0 0 16 15" 
                    fill="none"
                > 
                    <line x1="8.29188" y1="0.551354" x2="15.297" y2="7.68774" stroke="#5A5A5A"></line>
                    <line x1="7.6474" y1="14.625" x2="14.7181" y2="7.55353" stroke="#5A5A5A"></line>
                </svg>
            </span>

            <a href="/{{ $page->category->main_url }}/{{ $page->category->url }}" class="category_link">{{ $page->category->category }}</a>
            <span class="link_arrow">
                <svg 
                    xmlns="http://www.w3.org/2000/svg" 
                    width="16" height="15" 
                    viewBox="0 0 16 15" 
                    fill="none"
                > 
                    <line x1="8.29188" y1="0.551354" x2="15.297" y2="7.68774" stroke="#5A5A5A"></line>
                    <line x1="7.6474" y1="14.625" x2="14.7181" y2="7.55353" stroke="#5A5A5A"></line>
                </svg>
            </span>

            <a href="/{{ $page->category->main_url }}/{{ $page->app->url }}" class="category_link">{{ $page->app->name }}</a>
            <span class="link_arrow">
                <svg 
                    xmlns="http://www.w3.org/2000/svg" 
                    width="16" height="15" 
                    viewBox="0 0 16 15" 
                    fill="none"
                > 
                    <line x1="8.29188" y1="0.551354" x2="15.297" y2="7.68774" stroke="#5A5A5A"></line>
                    <line x1="7.6474" y1="14.625" x2="14.7181" y2="7.55353" stroke="#5A5A5A"></line>
                </svg>
            </span>

            <div class="category_link">Скачать</div>
        </div>
    </div>

    <div class="download-title-wrapper {{-- start --}}">
        <div class="download-title">Скачать {{ $page->app->name }}</div>
        <div class="download-start">Загрузка начнется через &nbsp<span class="download-start-counter">0</span>&nbsp секунд.</div>
        <div class="download-process">Загрузка началась ...</div>
        <div class="download-link">Если загрузка не началась,&nbsp<a href="{{ $page->app->file_on_server != '' ? $page->app->file_on_server : $page->app->file }}">жми сюда</a></div>
    </div>

    @include ('main.includes.yandex-block')
    
    {{-- Текстовое описание --}}
    @include ('main.includes.app-description', ['app' => $page->app, 'short' => true])

    {{-- Версии --}}
    {{-- <div class="app-versions">
        Версии
    </div> --}}

    {{-- Популярные приложения в данной категории --}}
    @include ('main.includes.horisontal-apps-list', [
        'list'  => $page->PopularInCategory,
        'title' => 'Топ популярных',
    ])
    
@endsection

@section('js-section')
    @vite(['resources/js/main/main.js'])
@endsection
