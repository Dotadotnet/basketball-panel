<div dir="ltr" class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
        <div class="col-lg-7 text-center text-lg-start">
            <img class="w-25" src="/images/Logo.jpg" />
            <h1 class="display-4 fw-bold lh-1 mb-3">سامانه بسکتبال</h1>
            <p class="col-lg-10 fs-4">پایگاه داده سند محور</p>
        </div>
        <div class="col-md-10 mx-auto col-lg-5">
            <form class="p-4 p-md-5 border rounded-3 bg-light" wire:submit.prevent="submit">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="username"
                        wire:model="username">
                    <label for="floatingInput">نام کاربری</label>
                    @error('username')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                        wire:model="password">
                    <label for="floatingPassword">رمز عبور</label>
                    @error('password')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">ورود</button>
            </form>
        </div>
    </div>
</div>
