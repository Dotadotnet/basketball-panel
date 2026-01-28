<div dir="ltr" class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
        <div class="col-lg-7 text-center text-lg-start">
            <h1 class="display-4 fw-bold lh-1 mb-3">سامانه بسکتبال</h1>
        </div>
        <div class="col-md-10 mx-auto col-lg-5">
            <form class="p-4 p-md-5 border rounded-3 bg-light" wire:submit.prevent="submit">
                @csrf
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingInput" placeholder="********" wire:model="password" name="password">
                    <label for="floatingInput">رمز جدید</label>
                    @error('password') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingInput" placeholder="********" wire:model="password_confirmation" name="password_confirmation">
                    <label for="floatingInput">تکرار رمز جدید</label>
                    @error('password') <span class="error">{{ $message }}</span> @enderror
                </div>
                <input type="hidden" name="url" value="{{ $url }}">
                <button class="w-100 btn btn-lg btn-primary" type="submit">ثــبــت</button>
                <hr class="my-4">
                <small class="text-muted">
                    <a href="{{ route('login') }}" class="text-muted text-decoration-none float-end">بازگشت</a>
                </small>
            </form>
        </div>
    </div>
</div>
