<!doctype html>
<html lang="fa">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.98.0">
    <title>@yield('title')</title>
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
    @yield('styles')
</head>
<body>
@yield('body')

@livewireScripts
<script src="{{ asset('bootstrap/js/bootstrap.js') }}" defer></script>
@yield('scripts')
</body>
</html>
