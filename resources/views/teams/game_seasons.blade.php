@extends('layout.accounts_template')

@section('content')

    <div class="container px-4 py-5">

        @component('components.history_of_player')
        @endcomponent
        
        <br>
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="input-group mb-3 h-100 d-flex align-items-center justify-content-center">
                    @if (!$game_seasons->isEmpty())
                        <table class="table table-striped text-center table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">لینک</th>
                                    <th scope="col">جنیست</th>
                                    <th scope="col">زمان شروع</th>
                                    <th scope="col">رده</th>
                                    <th scope="col">تاریخ فصل</th>
                                    <th scope="col">نام فصل مسابقات</th>
                                    <th scope="col">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($game_seasons as $g)
                                    <tr>
                                        <td>
                                            @if ($g->start_time_at <= now())
                                                <a href="{{ route('dashboard.team', Hashids::encode($g->id)) }}"
                                                    class="text-decoration-none">ورود</a>
                                            @else
                                                تا زمان شروع صبر کنید
                                            @endif
                                        </td>
                                        <td>
                                            @if ($g->gender == 'men')
                                                آقایان
                                            @else
                                                بانوان
                                            @endif
                                        </td>
                                        <td>{{ \Hekmatinasser\Verta\Verta::createTimestamp($g->start_time_at)->formatDatetime('Y/m/d H:i:s') }}
                                        <td>
                                            @foreach ($categories as $c)
                                                @if ($c->id == $g->category_id)
                                                    {{ $c->name }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $g->date }}</td>
                                        <td>{{ $g->name }}</td>
                                        <th scope="row">{{ ++$i }}</th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="input-group-prepend">
                            <div class="alert alert-danger">هیچ فصل مسابقه‌ای موجود نیست</div>
                            <div class="alert alert-info">شاید هنوز زمان شروع تحویل مدارک این فصل شروع نشده</div>
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
    <script></script>
@endsection
