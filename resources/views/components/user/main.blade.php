<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @section('title') پنل ادمین @show </title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('media/img/custom/image/admin.png') }}" type="image/x-icon">
    <!-- Custom styles -->
    <script src="https://kit.fontawesome.com/4fa9804fb1.js" crossorigin="anonymous"></script>
    @vite('resources/css/admin.css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/admin.min.css') }}">
    @vite('resources/js/admin.js')
</head>

<body>
    <div class="layer"></div>
    <!-- ! Body -->
    <a class="skip-link sr-only" href="#skip-target">Skip to content</a>
    <div class="page-flex">
        <!-- ! Sidebar -->
        @component('admin.layout.sidebar')
        @endcomponent
        <div class="main-wrapper">
            <!-- ! Main nav -->
            @component('admin.layout.navbar')
            @endcomponent
            <!-- ! Main -->
            <main class="main users chart-page p-2" id="skip-target">
                @yield('main')
            </main>
            <!-- ! Footer -->
            @component('admin.layout.footer')
            @endcomponent
        </div>
    </div>
    <div
        class="fixed p-2  show-order-info hidden flex top-0 text items-center justify-center size-full z-[10000] right-0 backdrop-blur dark:bg-dark-opacity-30 bg-light-opacity-30">
        <button
            class="font-bold text-2xl
cursor-pointer remove md:scale-125 absolute top-8 right-8
 dark:border-red-500 dark:text-red-500 
  text-red-700 border-red-700 close
  hover:border-red-500 hover:text-red-500 
dark:hover:text-red-700 dark:hover:border-red-700
border-[3px] size-10 flex items-center justify-center rounded-2xl close-search">
            <i class="fa fa-times" aria-hidden="true"></i>
        </button>
        <div
            class="bg-white  md:w-[500px] w-full max-h-[90vh] overflow-auto p-7 rounded-lg dark:bg-gray-800 border-2 border-blue-600">
            <div class=" loader-div flex p-5 justify-center">
                <span class="loader scale-150"></span>
            </div>
            <div class="all">
                <h3 class="text">
                    <b class="name"></b>
                    به شماره
                    <b class="phone"></b>
                </h3>
                <div class="flex flex-col p-2 max-h-[50vh] table-order overflow-auto">
                    
                </div>
                <br>
                <h3 class="text">
                    اطلاعات ارسال :
                </h3>
                <br>
                <div class="flex justify-center px-20">
                    <span
                        class="bg-gray-300 border-2 text-center border-blue-600 w-full dark:bg-gray-700 p-3 rounded-lg">
                        کد پستی : <b class="postal-code"></b>
                    </span>
                    <a href="/" target="_blank"
                        class="rounded-lg location bg-blue-600 text-white hover:text-white p-3 w-full text-center hover:bg-blue-700 cursor-pointer">
                        رفتن به لوکیشن مورد نظر
                    </a>
                </div>
                <br>
                <div class="flex px-28 justify-between">
                    <span class="bg-gray-300 border-2 border-blue-600 dark:bg-gray-700 p-3 rounded-lg">
                        پلاک : <b class="plate"></b>
                    </span>
                    <span class="bg-gray-300 border-2 border-blue-600 dark:bg-gray-700 p-3 rounded-lg">
                        واحد : <b class="unit"></b>
                    </span>
                </div>
            </div>

        </div>
    </div>
    <div>
        @php
            if ($errors->any()) {
                $errors = $errors->all();
            } elseif (Session::get('status') == 'successful') {
                $errors = 'successful';
            }
        @endphp
    </div>
    <script src="{{ asset('js/admin_script.min.js') }}"></script>
    <script src="{{ asset('js/feather.min.js') }}"></script>
    <script src="{{ asset('js/chart.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/polipop.min.css') }}" />
    <script src="{{ asset('js/polipop.min.js') }}"></script>
    <script>
        var errors = @json($errors);
        var polipop = new Polipop('mypolipop', {
            layout: 'popups',
            pool: 2,
            life: 2000,
        });
        setInterval(() => {
            window.ReloadComment()
        }, 50000)
    </script>
</body>

</html>
