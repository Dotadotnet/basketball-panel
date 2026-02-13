<!DOCTYPE html>
<html dir="rtl" class="dark" lang="fa">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.98.0">
    <title>@yield('title')</title>
    
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
    <link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png">
    <style>
        @font-face {
            font-weight: normal;
            font-style: normal;
            font-family: IRANSansX;
            src: url("https://bbms-tehran.ir/fonts/woff/Sans.ttf") format('truetype');
        }

        * {
            font-family: IRANSansX !important;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/polipop.min.css') }}" />
    @yield('styles')
</head>

<body>
    <style>
        input:-webkit-autofill {
            -webkit-box-shadow: 0 0 0px 1000px white inset;
            /* جایگزین پس‌زمینه آبی */
            -webkit-text-fill-color: black;
            /* رنگ متن */
            transition: background-color 5000s ease-in-out 0s;
            /* جلوگیری از فلش رنگ */
        }

        div.polipop__notification-content,
        div.polipop__notification-title {
            text-align: right !important;
        }

        div.polipop__notification-title {
            padding-right: 35px;
        }

        button.polipop__notification-close {
            position: absolute !important;
            left: 14.5px !important;
            padding-top: 3.5px !important;
            display: flex !important;
            transform: scale(1.5);
            justify-content: center !important;
            align-items: center !important;
        }

        @media (max-width: 426px) {
            div#mypolipop {
                transform: scale(0.8);
                transform-origin: top right;
            }


        }

        .polipop__notification_type_error {
            background-color: rgba(255, 0, 0, 0.5) !important;
        }

        .polipop__notification_type_success {
            background-color: rgba(0, 255, 0, 0.5) !important;
        }

        .polipop_theme_default {
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        }

        div.polipop__notification-icon {
            position: absolute !important;
            right: 10px !important;
        }

        span.polipop__closer-text {
            position: relative;
        }

        span.polipop__closer-text::after {
            position: absolute;
            content: "بستن";
            flex-wrap: nowrap;
            inset: 0;
            background-color: #333333 !important;
            /* کل المنت رو می‌گیره */
            background: rgba(0, 0, 0, 0.6);
            color: #fff;

            display: flex;
            align-items: center;
            /* وسط عمودی */
            justify-content: center;
            /* وسط افقی */

            font-size: 15px;
            cursor: pointer;
        }

        a,
        p {
            font-size: 12px;
            /* موبایل */
        }

        @media (max-width: 768px) {
            .form-group input {
                font-size: 14px;
            }

            .form-group label {
                font-size: 16px;
            }

        }


        @media (min-width: 768px) {

            a,
            p {
                font-size: 14px;
            }

            /* تبلت */
        }

        @media (min-width: 1200px) {


            a,
            p {
                font-size: 16px;
            }

            /* دسکتاپ */
        }
    </style>
    <script src="{{ asset('js/polipop.min.js') }}"></script>
    <script>
        var polipop = new Polipop('mypolipop', {
            layout: 'popups',
            pool: 3,
            life: 3000,
        });
    </script>
    @yield('body')
    <script>
        const messagesRes = @json(session('messages'));
        const messages = JSON.parse(messagesRes);
        if (messages) {
            if (Array.isArray(messages)) {
                messages.forEach((message) => {
                    polipop.add(message);
                })
            } else {
                polipop.add(messages);
            }
        }
    </script>
    {{-- @livewireScripts --}}

    <script src="{{ asset('bootstrap/js/bootstrap.js') }}" defer></script>
    @yield('scripts')

</body>

</html>
