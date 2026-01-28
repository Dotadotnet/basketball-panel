@extends('layout.admin_template')
@section('content')
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        <form dir="rtl" class="m-0" method="post"
              action="{{ route('admin.admin_users.store') }}">
            @csrf
            <div class="row">
                <div class="col-2"></div>
                <div class="col-4">
                    <div class="m-2">
                        <label for="name" class="form-label float-end">نام</label>
                        <input class="form-control" type="text" name="name" id="name">
                    </div>
                    @error('name') <p class="text-danger">{{ $message }}</p> @enderror

                    <div class="m-2">
                        <label for="surname" class="form-label float-end">نام خانوادگی</label>
                        <input class="form-control" type="text" name="surname" id="surname">
                    </div>
                    @error('surname') <p class="text-danger">{{ $message }}</p> @enderror

                    <div class="m-2">
                        <label for="email" class="form-label float-end">ایمیل</label>
                        <input class="form-control" type="text" name="email" id="email">
                    </div>
                    @error('email') <p class="text-danger">{{ $message }}</p> @enderror

                    <div class="m-2 mt-3">
                        <input class="form-control btn btn-outline-success" type="submit" value="ایــجــاد کــردن">
                    </div>
                </div>


                <div class="col-4">
                    <div class="m-2">
                        <label for="username" class="form-label float-end">نام کاربری</label>
                        <input class="form-control" type="text" name="username" id="username">
                    </div>
                    @error('username') <p class="text-danger">{{ $message }}</p> @enderror

                    <div class="m-2">
                        <label for="password" class="form-label float-end">رمز عبور</label>
                        <input class="form-control" type="password" name="password" id="password">
                    </div>
                    @error('password') <p class="text-danger">{{ $message }}</p> @enderror

                    <div class="m-2">
                        <label for="password_confirmation" class="form-label float-end">تکرار رمز عبور</label>
                        <input class="form-control" type="password" name="password_confirmation" id="password_confirmation">
                    </div>
                    @error('password_confirmation') <p class="text-danger">{{ $message }}</p> @enderror

                    <div class="m-2 mt-3">
                        <a href="{{ route('admin.admin_users.index') }}" class="form-control btn btn-outline-primary">بازگشت به لیست</a>
                    </div>
                </div>
                <div class="col-2"></div>
            </div>
        </form>
    </div>
@endsection
