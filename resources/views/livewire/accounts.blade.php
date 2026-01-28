<div dir="ltr" class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
        <div class="col-lg-7 text-center text-lg-start">
            <h1 class="display-4 fw-bold lh-1 mb-3">سامانه بسکتبال</h1>
            {{--            <p class="col-lg-10 fs-4">پایگاه داده سند محور</p>--}}
        </div>
        <div class="col-md-10 mx-auto col-lg-5">
            <form class="p-4 p-md-5 border rounded-3 bg-light" wire:submit.prevent="submit">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="احسان" wire:model="name">
                    <label for="floatingInput">نام</label>
                    @error('name') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingPassword" placeholder="حسابی" wire:model="surname">
                    <label for="floatingPassword">نام خانوادگی</label>
                    @error('surname') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" wire:model="email">
                    <label for="floatingInput">آدرس ایمیل</label>
                    @error('email') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingInput" placeholder="password" wire:model="password">
                    <label for="floatingInput">رمز عبور</label>
                    @error('password') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="0912123456" wire:model="cellphone">
                    <label for="floatingInput">شماره موبایل</label>
                    @error('cellphone') <span class="error">{{ $message }}</span> @enderror
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">ثبت نام</button>
                <hr class="my-4">
                <small class="text-muted">
                    <a href="{{ route('login') }}" class="text-muted text-decoration-none float-end">حساب کاربری دارم. <b>می خواهم وارد شوم</b></a>
                </small>
            </form>
        </div>
    </div>
</div>
