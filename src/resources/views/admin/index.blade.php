@extends('layouts.admin')

@section('css-section')
    @vite(['resources/sass/admin/admin.scss'])
@endsection

@section('main-section')
    <div id="app">
        <main-admin></main-admin>
    </div>
@endsection

@section('js-section')
    @vite(['resources/js/admin/admin.js'])
@endsection
