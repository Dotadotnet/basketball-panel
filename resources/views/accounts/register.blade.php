@extends('layout.auth')
@section('title')
    ثبت نام
@endsection
@section('bodyAuth')
    <form method="POST" action="/auth/userRegister">
        @csrf
        <div class="form-group">
            <label dir="rtl" class="direction-rtl  pe-4 w-100" for="name">نام
                :</label>
            <input dir="rtl" name="name" placeholder="علی" type="text" class="p-2 mt-2 form-control" id="name"
                aria-describedby="name">
        </div>
        <div class="form-group">
            <label dir="rtl" class="direction-rtl my-2 pe-4 w-100" for="surname">نام خانوادگی
                :</label>
            <input dir="rtl" name="surname" placeholder="محرابی" type="text" class="p-2 form-control" id="surname"
                aria-describedby="surname">
        </div>
        <div class="form-group">
            <label dir="rtl" class="direction-rtl my-2 pe-4 w-100" for="phone">شماره تلفن
                :</label>
            <input dir="rtl" name="phone" placeholder="09121111111" type="text" class="p-2 form-control"
                id="phone" aria-describedby="phone">
        </div>
        <div class="form-group">
            <label dir="rtl" class="direction-rtl my-2 pe-4 w-100" for="email">آدرس ایمیل
                :</label>
            <input dir="rtl" name="email" placeholder="example@gmail.com" type="text" class="p-2 form-control"
                id="email" aria-describedby="email">
        </div>


        @component('components.passwordInput', ['show' => true, 'text' => 'یک رمز برای خود بنویسید'])
        @endcomponent

        <br />
        <div class="container ">
            <button class="w-100 d-flex justify-content-center align-items-center btn btn-lg btn-primary"
                type="submit">ثبت</button>

        </div>
        <hr>
        <div class="my-3 pb-1">
            <a href="{{ route('login') }}" class="text-muted fs-8 text-decoration-none float-end">حساب کاربری دارید ؟
                <b>ورود کنید</b></a>
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
        const registerData = decodeURIComponent(getCookie('registerData'));
        if (registerData) {
            const data = JSON.parse(registerData); // decode JSON
            for (const key in data) {
                const input = document.querySelector(`input[name="${key}"]`);
                if (input) input.value = data[key];
            }
        }
    </script>
@endsection
