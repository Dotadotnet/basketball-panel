@extends('layout.accounts_template')

@section('content')
    <div class="container px-4 py-5">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="input-group mb-3 h-100 d-flex align-items-center justify-content-center">
                    <form method="post" enctype="multipart/form-data"
                          action="{{ route('dashboard.payment.receipt.process') }}">
                        @if(Session::has('message'))
                            <div class="form-group text-end mb-3" style="width: 550px">
                                <p class="alert alert-success">{{ Session::get('message') }}</p>
                            </div>
                        @endif
                        @if(Session::has('error'))
                            <div class="form-group text-end mb-3" style="width: 550px">
                                <p class="alert alert-danger" style="text-align: center">{!! Session::get('error') !!}</p>
                            </div>
                        @endif
                        @csrf
                        <div class="form-group text-end mb-3" style="width: 550px">
                            <label for="exampleInputEmail1">تصویر فیش واریزی</label>
                            <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                   name="picture">
                            <small id="emailHelp" class="form-text text-muted">در اینجا تصویر فیش واریزی را از دستگاه
                                خود انتخاب کنید</small>
                            @error('picture') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group text-end mb-3" style="width: 550px">
                            <label for="date">تاریخ</label>
                            <input type="text" class="form-control" id="date" placeholder="همانند 1401/01/01"
                                   name="date" aria-describedby="date">
                            <small id="date" class="form-text text-muted">تاریخ پرداخت ثبت شده روی فیش را اینجا وارد
                                نمایید</small>
                            @error('date') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary float-end">ثبت فیش</button>
                    </form>
                </div>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/sweetalert_2.1.0.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}" crossorigin="anonymous"></script>
    <script>

    </script>
@endsection
