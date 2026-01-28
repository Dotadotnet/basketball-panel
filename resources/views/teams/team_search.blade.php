@extends('layout.accounts_template')

@section('content')
    <div class="container px-4 py-5">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="input-group mb-3 h-100 d-flex align-items-center justify-content-center">
                    @if(!$teams_names->isEmpty())
                        <table class="table table-striped text-center table-hover">
                            <thead>
                            <tr>
                                <th scope="col">لینک</th>
                                <th scope="col">نام</th>
                                <th scope="col">#</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($teams_names as $t)
                                <tr>
                                    <td>
                                        <a href="{{ route('dashboard.team.list', ['id' => $id, 'name_id' => Hashids::encode($t->id)]) }}" class="text-decoration-none">ورود</a>
                                    </td>
                                    <td>{{ $t->name }}</td>
                                    <th scope="row">{{ ++$i }}</th>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="input-group-prepend text-center col-8">
                            <div class="alert alert-danger">هیچ تیمی با این نام یافت نشد</div>
                            <div class="alert alert-info">
                                <a href="{{ route('dashboard.team.create', ['id' => $id]) }}" class="text-decoration-none">
                                    راهنما: برای ایجاد نام تیم اینجا کلیک کنید
                                </a>
                            </div>
                        </div>
                    @endif
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
