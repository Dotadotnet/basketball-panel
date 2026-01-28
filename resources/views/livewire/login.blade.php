<link rel="stylesheet" href="{{ asset('css/polipop.min.css') }}" />
<script src="{{ asset('js/polipop.min.js') }}"></script>
<script>
    var polipop = new Polipop('mypolipop', {
        layout: 'popups',
        pool: 2,
        life: 2000,
    });
</script>
<div style=" height: 100vh; " class="d-sm-flex">
    <div dir="ltr" class="container col-xl-10 col-xxl-8 ">
        <div style="width: 100%; " class="row h-100 align-items-lg-center">
            <div style="display: flex"
                class="col-lg-7 align-items-center justify-content-center p-md-5 p-5 text-center  text-lg-start">
                <img class="w-75" src="/images/Logo.jpg" />
            </div>

            <div class="col-md-10 mx-auto col-lg-5">
                <form class="p-4 p-md-4 rounded-3 bg-light" wire:submit.prevent="submit">
                    @csrf

                    <div class="form-group">
                        <label dir="rtl" class="direction-rtl mb-2 pe-4 w-100" for="email">آدرس ایمیل
                            :</label>
                        <input dir="rtl" name="username" placeholder="ایمیل خود را وارد کنید" type="email"
                            class="form-control" id="email" aria-describedby="email">
                    </div>
                    <div class="form-group mt-2">
                        <label dir="rtl" class="direction-rtl mb-2 pe-4 w-100" for="password">رمز عبور
                            :</label>
                        <input dir="rtl" name="password" placeholder="رمز عبور خود را وارد کنید" type="password"
                            class="form-control" id="password" aria-describedby="password">
                    </div>

                    <br />
                    <div class="container ">
                        <button class="w-100 d-flex justify-content-center align-items-center btn btn-lg btn-primary"
                            type="submit">ورود</button>
                    </div>
                    <div class="my-4">
                        <a href="{{ route('register') }}" class="text-muted text-decoration-none float-end">اگرحساب
                            کاربری ندارید؟ <b>ثبت نام</b></a>
                        <br>
                        <a href="{{ route('forgot.password') }}" class="text-muted text-decoration-none float-end">رمز
                            عبورتان را گم کرده اید؟ <b>ایجاد رمز جدید</b></a>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>


<script>
    const form = document.querySelector("form");
    const btn = document.querySelector("form button[type~=submit]");l
</script>