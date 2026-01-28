@extends('layout.accounts_template')

@section('content')
    <div class="container px-4 py-5">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10 mt-5">
                <form method="post" action="{{ route('dashboard.team.create.process', ['id' => $id]) }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control text-center" id="inputGroupFile01" name="team" placeholder="فقط نام تیم خود را که در لیست موجود نیست وارد نمایید">
                        <label class="input-group-text" for="inputGroupFile01">نام تیم</label>
                        @error('team') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="input-group mb-3 float-end" style="width: 150px">
                        <input type="submit" class="form-control btn btn-success" value="ثبت تیم">
                    </div>
                </form>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
@endsection
