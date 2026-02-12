@extends('layout.auth')
@section('title')
    فراموشی رمز عبور
@endsection
@section('bodyAuth')
    <form method="POST" action="/auth/forgot-password">
        @csrf
        <h1
            style="gap:10px;font-size: 20px;text-align: right; padding-right: 20px;display: flex;align-items: center;justify-content: end">
            فراموشی رمز عبور
            <svg style="font-size: 15px;width: 25px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                    <path
                        d="m10 1.75c-2.34721 0-4.25 1.90279-4.25 4.25.00023.37267.04949.74369.14648 1.10352l-4.14648 4.14648v3h3v-1.5h1.5v-1.5h1.5l1.15039-1.15039c.35839.0980.72808.1486 1.09961.1504 2.3472 0 4.25-1.90279 4.25-4.25s-1.9028-4.25-4.25-4.25z" />
                    <circle cx="10.75" cy="5.25" r=".5" fill="currentColor" />
                </g>
            </svg>
        </h1>
        <div class="form-group mt-3">
            <label dir="rtl" class="direction-rtl pe-4 w-100" for="email">آدرس ایمیل
                :</label>
            <input dir="rtl" name="email" placeholder="ایمیل خود را وارد کنید" type="text"
                class="p-2 mt-2 form-control" id="email" aria-describedby="email">
        </div>

        <div id="hidden-item" style="display: none;">
            @component('components.passwordInput', ['show' => true, 'text' => 'یک رمز برای خود بنویسید'])
            @endcomponent
        </div>
        <div dir="rtl" style="justify-items: right;align-items: center;cursor: pointer;"
            class="form-check pe-3 d-flex mt-3">
            <input dir="rtl" class="form-check-input " style="width: 20px;height:20px ;" type="checkbox"
                id="toggle">
            <label dir="rtl" class="form-check-label"
                style="margin-right: 30px ;cursor: pointer; margin-top: 5px;user-select: none " for="toggle"
                id="label-text">
                ایجاد رمز عبور جدید
            </label>
        </div>
        <br />
        <div class="container ">
            <button class="w-100 d-flex justify-content-center align-items-center btn btn-lg btn-primary"
                type="submit">دریافت رمز</button>
        </div>
    </form>
@endsection
@section('scriptAuth')
    <script>
        const btnSubmit = document.querySelector("form button[type~=submit]");

        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
            return null;
        }
        const registerData = decodeURIComponent(getCookie('loginData'));

        if (registerData) {
            const data = JSON.parse(registerData); // decode JSON

            const input = document.querySelector(`input[name="email"]`);
            input.value = data["email"];
        }



        const checkbox = document.getElementById('toggle');
        const item = document.getElementById('hidden-item');
        const labelText = document.querySelector('#label-text');

        const inputPass = document.querySelector(`input[name="password"]`);
 

        setTimeout(() => {
            inputPass.value = "";
        }, 1000);

        checkbox.addEventListener('change', () => {
            if (checkbox.checked) {
                item.style.display = 'block';
                btnSubmit.textContent = 'تغییر رمز';
                inputPass.value = "";
                inputPass.focus()
            } else {
                item.style.display = 'none';
                btnSubmit.textContent = 'دریافت رمز';
            }
        });
    </script>
@endsection
