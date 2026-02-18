@extends('layout.auth')
@section('title')
    ورود
@endsection
@section('bodyAuth')

    <form method="POST" action="/auth/adminLogin">
        @csrf
        <div class="form-group">
            <label dir="rtl" class="direction-rtl mb-2 pe-4 w-100" for="username">نام کابری
                :</label>
            <input dir="rtl" name="username" placeholder="ایمیل یا نام کاربری" type="text" class="p-2 form-control"
                id="username" aria-describedby="username">
        </div>


        @component('components.passwordInput')
        @endcomponent

        <br />
        <div class="container ">
            <button class="w-100 d-flex justify-content-center align-items-center btn btn-lg btn-primary"
                type="submit">ورود</button>

        </div>
    </form>
@endsection

