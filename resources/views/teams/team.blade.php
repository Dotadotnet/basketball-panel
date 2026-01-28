@extends('layout.accounts_template')

@section('content')
    <div class="container px-4 py-5">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="input-group mb-3 h-100 d-flex align-items-center justify-content-center">
                    <form action="{{ route('dashboard.team.search', ['id' => $id]) }}" method="get">
                        @csrf
                        <div class="input-group" style="width: 450px">
                            <input type="search" name="team" class="form-control rounded text-center" placeholder="نام تیم خود را جستجو کنید" aria-label="Search" aria-describedby="search-addon" />
                            <button type="submit" class="btn btn-outline-primary">جستجو</button>
                        </div>
                        @error('team') <span class="error">{{ $message }}</span> @enderror
                        @if(Session::has('message'))
                            <div class="alert alert-info alert-dismissible fade show mt-5" role="alert" dir="rtl">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>{{ Session::get('message') }}</strong>
                            </div>
                        @endif
                    </form>
                </div>

            </div>
            <div class="col-1"></div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}" crossorigin="anonymous"></script>
    <script>

    </script>
@endsection
