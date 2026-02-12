@extends('layout.accounts_template')

@section('content')
    <div class="container px-4 py-5">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="input-group mb-3 h-100 d-flex align-items-center justify-content-center">
                    <div class="col-3 text-center mb-3 rounded">
                        <form method="POST" action="{{ route('dashboard.list.confirm', [
                                            'seasons_game_id' => $game_season_id,
                                            'team_id' => $team_name_id
                                            ]) }}">
                            @csrf
                            <button type="submit" class="btn btn-xs btn-outline-danger btn-flat show_final_confirm"
                                    data-toggle="tooltip" title='Confirm'>برای ثبت نهایی کل لیست کلیک کنید
                            </button>
                        </form>
                    </div>
                    <div class="col-1"></div>
                    <div class="col-2 btn btn-success text-center mb-3 rounded">
                        <a href="{{ route('dashboard.team.list.entry.person', ['id' => $game_season_id, 'name_id' => $team_name_id]) }}"
                           class="text-decoration-none" style="color: white">اضافه کردن شخص +</a>
                    </div>
                    <div class="col-1"></div>
                    @if($pdf_link == true)
                        <div class="col-1"></div>
                        <div class="col-2 btn btn-primary text-center mb-3 rounded"
                             title="حداقل پنج بازیکن و یک کادرفنی برای فعال شدن چاپ لازم است">

                            <a class="text-decoration-none" style="color: white" href="{{ route('dashboard.print.download', [
                                            'game_season' => $game_season_id,
                                            'team' => $team_name_id
                                            ]) }}">چاپ لیست اسامی</a>
                        </div>
                    @else 
                        <div class="col-3 alert alert-danger rounded text-center justify-content-center">
                            حداقل پنج بازیکن و یک کادرفنی برای فعال شدن چاپ لازم است
                        </div>
                    @endif
                    @if(!$list->isEmpty())
                        <table class="table table-striped text-center table-hover">
                            <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col">ثبت نهایی</th>
                                <th scope="col">شماره پیراهن</th>
                                <th scope="col">سمت</th>
                                <th scope="col">تاریخ تولد</th>
                                <th scope="col">نام خانوادگی</th>
                                <th scope="col">نام</th>
                                <th scope="col">#</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $l)
                                <tr>
                                    <td>
                                        @if($l->status_user_submit == 'undone')
                                            <form method="POST" action="{{ route('dashboard.list.delete', [
                                            'seasons_game_id' => $game_season_id,
                                            'team_id' => $team_name_id,
                                            'list_id' => Hashids::encode($l->id)
                                            ]) }}">
                                                @csrf
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button type="submit"
                                                        class="btn btn-xs btn-outline-danger btn-flat show_confirm"
                                                        data-toggle="tooltip" title='Delete'>حذف
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                    <td>
                                        @if($l->status_approved == 'undone')
                                            <a href="{{ route('dashboard.team.list.edit', ['id' => $game_season_id, 'name_id' => $team_name_id, 'list_id' => Hashids::encode($l->id)]) }}"
                                               class="text-decoration-none btn btn-xs btn-outline-primary">ویرایش</a>
                                        @else
                                            <a title="{{ "در تاریخ {$l->status_approved_at} توسط هیات تایید شده" }}"
                                               class="btn btn-danger">غیرقابل ویرایش</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($l->status_user_submit == 'undone')
                                            {{ 'انجام نشده' }}
                                        @else
                                            {{ 'انجام گردید' }}
                                        @endif
                                    </td>
                                    <td>{{ $l->t_shirt_number }}</td>
                                    <td>
                                        @foreach($post as $p)
                                            @if($p->id == $l->post_id)
                                                {{ $p->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $l->birthdate }}</td>
                                    <td>{{ $l->surname }}</td>
                                    <td>{{ $l->name }}</td>
                                    <th scope="row">{{ ++$i }}</th>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="input-group-prepend text-center col-8">
                            <div class="alert alert-danger">هیچ شخصی در این تیم یافت نشد</div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-1"></div>
        </div>
        {{ $list->links() }}
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/sweetalert_2.1.0.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}" crossorigin="anonymous"></script>
    <script>
        $('.show_confirm').click(function (event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: `آیا از حذف کردن این شخص از لیست اطمینان دارید؟`,
                text: ".اگر این را حذف کنید برای همیشه از بین خواهد رفت",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
        $('.show_final_confirm').click(function (event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: `آیا از ثبت نهایی تمام افراد لیست اطمینان دارید؟`,
                text: "پس از تایید امکان حذف کردن برداشته شده سپس روند بررسی افراد لیست زیر شروع خواهد شد، درصورت ایراد داشتن لیست امکان تایید میسر نمی‌باشد",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>
@endsection
