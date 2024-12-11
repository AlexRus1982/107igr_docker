@extends('layouts.main')

@section('header-section')
    Блог
@endsection

@section('main-section')
    {{ $page->blog->title}}
@endsection

@section('js-section')
    @vite(['resources/js/main/main.js'])
@endsection
