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
    <!-- Custom styles -->
    <script src="https://kit.fontawesome.com/4fa9804fb1.js" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  
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
