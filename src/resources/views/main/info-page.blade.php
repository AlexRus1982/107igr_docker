{{-- main_url --}}
@extends('layouts.main')

@section('main-section')
    @php
        // logger(json_encode($page, JSON_UNESCAPED_UNICODE));
    @endphp

    <div class="info_page_wrapper">
        <div class="info_page">
            <h1 class="info_page_title">{{ $page->name }}</h1>
            <div>{!! $page->description !!}</div>
        </div>
    </div>

@endsection

{{-- @section('js-section')
    @vite(['resources/js/main/main.js'])
@endsection --}}
