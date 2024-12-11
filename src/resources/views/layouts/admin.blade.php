<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Панель администрирования</title>

    {{-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> --}}

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <script src="https://cdn.tiny.cloud/1/z5njsmxz6lk6ae7dg2xs4p62r9vg8nwcof7kd5sahfyyjfui/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    {{-- <link href='/css/materialdesignicons.min.css' rel='stylesheet'>
    <link href='/css/vuetify.min.css' rel='stylesheet'> --}}

    @vite(['resources/sass/admin/admin.scss'])

</head>
    <body>
        <main>
            @yield('main-section')
        </main>
    </body>

    @yield('js-section')
</html>
