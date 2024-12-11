@extends('layouts.main')

@section('main-section')
    {{ $page->blogs->count()}}
@endsection

@section('js-section')
    @vite(['resources/js/main/main.js'])
@endsection
