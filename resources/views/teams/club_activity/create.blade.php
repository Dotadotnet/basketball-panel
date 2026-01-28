@extends('layout.accounts_template')

@section('content')
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        <form dir="rtl" class="m-0" method="post"
              action="{{ route('dashboard.my_club.store') }}">
            @csrf
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8">
                    <div class="m-2">
                        <label for="name" class="form-label float-end">نام باشگاه</label>
                        <input class="form-control" type="text" name="name" id="name">
                    </div>
                    @error('name') <p class="text-danger">{{ $message }}</p> @enderror

                    <div class="m-2">
                        <label for="surname" class="form-label float-end">آدرس</label>
                        <input class="form-control" type="text" name="address" id="address">
                    </div>
                    @error('address') <p class="text-danger">{{ $message }}</p> @enderror

                    <div class="m-2">
                        <label for="email" class="form-label float-end">شماره باشگاه</label>
                        <input class="form-control" type="text" name="number_phone" id="number_phone">
                    </div>
                    @error('number_phone') <p class="text-danger">{{ $message }}</p> @enderror

                    <div class="m-2 mt-3">
                        <input class="form-control btn btn-outline-success" type="submit" value="ایــجــاد کــردن">
                    </div>
                    <div class="m-2 mt-3">
                        <a href="{{ route('dashboard.my_club.index') }}" class="form-control btn btn-outline-primary">بازگشت به لیست</a>
                    </div>

                </div>
                <div class="col-2"></div>
            </div>
        </form>
    </div>
@endsection

