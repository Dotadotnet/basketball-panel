@extends('layout.admin_template')
@section('content')
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        @csrf
        <div class="row">
            <div class="col-8"></div>
            <div class="col-4">
                <a href="{{ route('admin.setting.game_season.create') }}" class="btn btn-success text-center mb-3 rounded w-100">ایــجــاد +</a>
            </div>
        </div>
        <div class="row align-items-center g-lg-5 py-5">
            <div class="col-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th scope="col" class="text-center">تاریخ پایان</th>
                        <th scope="col" class="text-center">تاریخ شروع</th>
                        <th scope="col" class="text-center">جنسیت</th>
                        <th scope="col" class="text-center">سن مجاز</th>
                        <th scope="col" class="text-center">رده</th>
                        <th scope="col" class="text-center">وضعیت</th>
                        <th scope="col" class="text-center">تاریخ</th>
                        <th scope="col" class="text-center">فصل</th>
                        <th scope="col" class="text-center">#</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $l)
                        <tr>
                            <td class="text-center">
                                <form method="POST"
                                      action="{{ route('admin.setting.game_season.destroy', ['id' => Hashids::encode($l->id)]) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"
                                            class="btn btn-xs btn-outline-danger btn-flat show_delete"
                                            data-toggle="tooltip" title='Delete'>حذف
                                    </button>
                                </form>
                            </td>
                            <td class="text-center">
                                <form method="get"
                                      action="{{ route('admin.setting.game_season.edit', ['id' => Hashids::encode($l->id)]) }}">
                                    @csrf
                                    <button type="submit"
                                            class="btn btn-xs btn-outline-primary btn-flat show_edit"
                                            data-toggle="tooltip" title='Edit'>ویرایش
                                    </button>
                                </form>
                            </td>
                            <td class="text-center">{{ $tools->convertGregorianToJalali($l->finish_time_at) }}</td>
                            <td class="text-center">{{ $tools->convertGregorianToJalali($l->start_time_at) }}</td>
                            <td class="text-center">
                                @if($l->gender == 'men')
                                    {{ 'آقا' }}
                                @else
                                    {{ 'خانم' }}
                                @endif
                            </td>
                            <td class="text-center">
                                @foreach($allowAge as $age)
                                    @if($age->id == $l->teams_allowed_age_id)
                                        {{ $age->date }}
                                    @endif
                                @endforeach
                            </td>
                            <td class="text-center">
                                @foreach($category as $c)
                                    @if($c->id == $l->category_id)
                                        {{ $c->name }}
                                    @endif
                                @endforeach
                            </td>
                            <td class="text-center">
                                @if($l->status == 'notStarted')
                                    {{ 'شروع نشده' }}
                                @elseif($l->status == 'done')
                                    {{ 'تمام شده' }}
                                @elseif($l->status == 'doing')
                                    {{ 'در حال برگزاری' }}
                                @endif
                            </td>
                            <td class="text-center">{{ $l->date }}</td>
                            <td class="text-center">{{ $l->name }}</td>
                            <td class="text-center">{{ ++$i }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $list->links() }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/sweetalert_2.1.0.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}" crossorigin="anonymous"></script>
    <script>
        $('.show_delete').click(function (event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: `آیا از حذف کردن این فصل مسابقاتی اطمینان دارید؟`,
                text: "اگر این را حذف کنید برای همیشه از بین خواهد رفت و بازگردانی اطلاعات مرتبط به آن(تیم‌ها، لیست صورت اسامی و ...) ممکن نخواهد بود",
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
        $('.show_edit').click(function (event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: `آیا از ویرایش این فصل مسابقاتی مطمئن هستید؟`,
                text: "ویرایش این اطلاعات ممکن است جبران ناپذیر باشد",
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
