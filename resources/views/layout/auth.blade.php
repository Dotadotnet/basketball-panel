@extends('layout.initialize')
@section('title')
    @yield('title')
@endsection
@section('body')
    @yield('style')
    <div style=" height: 100vh; " class="d-lg-flex">
        <div dir="ltr" class="container d-flex justify-content-center col-xl-10 col-xxl-8 ">
            <div style="width: 100%; " class="row h-100 align-items-lg-center">
                <div style="display: flex"
                    class="col-lg-7 align-items-center justify-content-center p-4 text-center  text-lg-start">
                    <img class="w-75" src="/images/Banner.jpg" />
                </div>
                <div class="col-md-10 mx-auto col-lg-5">
                    <div class="p-4 p-md-4 border rounded-3 bg-light">
                        @yield('bodyAuth')
                    </div>
                </div>

            </div>
        </div>
    </div>
    @yield('scriptAuth')

    <script>
        const loader =
            `<div class="spinner-border text-white" role="status"><span class="visually-hidden">Loading...</span></div>`
        const btn = document.querySelector("form button[type~=submit]");
        const btnText = btn.innerHTML;
        const form = document.querySelector("form");
        const action = form.action;
        const host = window.location.host;

        const endLoading = () => {
            btn.innerHTML = btnText
        };
        btn.addEventListener("click", () => {
            btn.innerHTML = loader;
        })

        btn.innerHTML = btnText


        const messagesRes = @json(session('messages'));
        const messages = JSON.parse(messagesRes);

        if (Array.isArray(messages)) {
            messages.forEach((message) => {
                polipop.add(message);
            })
        } else {
            polipop.add(messages);
        }
    </script>
@endsection
