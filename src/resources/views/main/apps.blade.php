@extends('layouts.main')

@section('main-section')
    apps
@endsection

@section('js-section')
    @vite(['resources/js/main/main.js'])
@endsection
