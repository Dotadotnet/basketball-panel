@extends('layout.initialize')
@section('title')
    داشبورد کاربران @yield('titleSecond')
@endsection
@section('styles')
    {{-- <link href="{{ asset('templates/accounts/bootstrap.min.css') }}" rel="stylesheet" crossorigin="anonymous"> --}}
    <meta name="theme-color" content="#712cf9">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @section('title') پنل ادمین @show </title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('media/img/custom/image/admin.png') }}" type="image/x-icon">
    <!-- Custom styles -->
    <script src="https://kit.fontawesome.com/4fa9804fb1.js" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/admin.min.css') }}">
    {{-- <link href="{{ asset('templates/accounts/sidebars.css') }}" rel="stylesheet"> --}}
@endsection
@section('body')
    <div class="layer"></div>
    <!-- ! Body -->
    <a class="skip-link sr-only" href="#skip-target">Skip to content</a>
    <div class="page-flex">
        <!-- ! Sidebar -->
        @component('components.user.sidebar')
        @endcomponent
        <div class="main-wrapper">
            <!-- ! Main nav -->
            @component('components.user.navbar')
            @endcomponent
            <!-- ! Main -->
            <main class="main users chart-page p-2" id="skip-target">
                @yield('content')
            </main>
            <!-- ! Footer -->
            @component('components.user.footer')
            @endcomponent
        </div>
    </div>
     <script src="{{ asset('js/admin_script.min.js') }}"></script>
    <script src="{{ asset('js/feather.min.js') }}"></script>
    <script src="{{ asset('templates/accounts/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>
@endsection
