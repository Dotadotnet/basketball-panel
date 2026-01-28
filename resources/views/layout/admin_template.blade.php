@extends('layout.initialize')
@section('title') داشبورد ادمین @yield('titleSecond') @endsection
@section('styles')
    <link href="{{ asset('templates/accounts/bootstrap.min.css') }}" rel="stylesheet" crossorigin="anonymous">

    <!-- Favicons -->
    <meta name="theme-color" content="#712cf9">


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


    <!-- Custom styles for this template -->
    <link href="{{ asset('templates/accounts/sidebars.css') }}" rel="stylesheet">
@endsection
@section('body')

<main class="d-flex flex-nowrap">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
            <span class="fs-4">داشبورد ادمین</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto"  dir="rtl">
            <li class="nav-item">
                <a href="{{ route('admin.review.confirmation.list') }}" class="nav-link active" aria-current="page">
                    بررسی ورود اطلاعات
                </a>
            </li>
            <li>
                <a href="{{ route('admin.payment') }}" class="nav-link text-white">
                    پرداختی‌ها
                </a>
            </li>
            <li>
                <a href="{{ route('admin.setting.game_season.list') }}"  class="nav-link text-white">
                    تنظیمات فصل مسابقاتی
                </a>
            </li>
            <li>
                <a href="{{ route('admin.admin_users.index') }}" class="nav-link text-white">
                    کاربران ادمین
                </a>
            </li>
            <li>
                <a href="{{ route('admin.logout') }}" class="nav-link text-white">
                    خروج
                </a>
            </li>
        </ul>
    </div>
    <div class="b-example-divider b-example-vr"></div>
    @yield('content')
</main>




@endsection

@section('scripts')
    <script src="{{ asset('templates/accounts/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>

    <script src="{{ asset('templates/accounts/sidebars.js') }}"></script>
@endsection
