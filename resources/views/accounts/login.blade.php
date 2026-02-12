@extends('layout.auth')
@section('title')
    ورود
@endsection
@section('bodyAuth')
    <form method="POST" action="/auth/userLogin">
        @csrf
        <div class="form-group">
            <label dir="rtl" class="direction-rtl mb-2 pe-4 w-100" for="email">آدرس ایمیل
                :</label>
            <input dir="rtl" name="email" placeholder="ایمیل خود را وارد کنید" type="text" class="p-2 form-control"
                id="email" aria-describedby="email">
        </div>


        @component('components.passwordInput')
        @endcomponent

        <br />
        <div class="container ">
            <button class="w-100 d-flex justify-content-center align-items-center btn btn-lg btn-primary"
                type="submit">ورود</button>

        </div>
        <hr>
        <div class="my-3">
            <a href="{{ route('register') }}" class="text-muted fs-8 text-decoration-none float-end">حساب
                کاربری ندارید؟ <b>ثبت نام کنید</b></a>
            <br>
            <a href="{{ route('forgot.password') }}" class="text-muted mt-1 text-decoration-none float-end">رمز
                عبورتان را فراموش کرده اید؟ <b> دریافت رمز </b></a>
        </div>

    </form>
@endsection
@section('scriptAuth')
    <script>
        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
            return null;
        }
        const registerData = decodeURIComponent(getCookie('loginData'));
        console.log(registerData);
        
        if (registerData) {
            const data = JSON.parse(registerData); // decode JSON
            for (const key in data) {
                const input = document.querySelector(`input[name="${key}"]`);
                if (input) input.value = data[key];
            }
        }
    </script>
@endsection
