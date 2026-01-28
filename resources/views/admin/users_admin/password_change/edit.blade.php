@extends('layout.admin_template')
@section('title')
    ویرایش رمزعبور
@endsection
@section('content')
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        <div class="row">
            <div class="col-12">
                <p class="text-center text-bg-warning rounded p-2">در این جا فقط می‌توان رمزعبور تغییر یافته را مشاهده کرد</p>
                <p class="text-center text-bg-warning rounded p-2">پیشنهاد می‌گردد رمزعبور جدید را در جایی نگه‌داری کنید</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <div class="m-2">
                    <label for="name" class="form-label float-end">نام</label>
                    <input class="form-control" type="text" name="name" id="name" disabled value="{{ $user->name }}">
                </div>
                @error('name') <p class="text-danger">{{ $message }}</p> @enderror

                <div class="m-2">
                    <label for="surname" class="form-label float-end">نام خانوادگی</label>
                    <input class="form-control" type="text" name="surname" id="surname" disabled value="{{ $user->surname }}">
                </div>
                @error('surname') <p class="text-danger">{{ $message }}</p> @enderror

                <div class="m-2">
                    <label for="email" class="form-label float-end">ایمیل</label>
                    <input class="form-control" type="text" name="email" id="email" disabled value="{{ $user->email }}">
                </div>
                @error('email') <p class="text-danger">{{ $message }}</p> @enderror

                <div class="m-2">
                    <label for="password" class="form-label float-end">رمزعبور جدید</label>
                    <input class="form-control" type="text" name="password" id="password" disabled value="{{ $new_password }}">
                </div>
            </div>
            <div class="col-4"></div>
        </div>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4"></div>
            <div class="col-4">
                <a class="btn btn-primary" href="{{ route('admin.admin_users.index') }}">بازگشت</a>
            </div>
        </div>
    </div>
@endsection
