@extends('layout.admin_template')
@section('content')
    <div class="container">
        <div class="row mt-3">
            <div class="col-4"></div>
            <div class="col-4">
                @if(Session::has('message'))
                    <div class="alert alert-primary text-center">{{ Session::get('message') }}</div>
                @endif
            </div>
            <div class="col-4">
                <a href="{{ route('admin.admin_users.create') }}" class="btn btn-success text-center mb-3 rounded w-100">ایــجــاد +</a>
            </div>
        </div>
        <table class="table table-hover">
            <thead class="table-dark">
            <tr>
                <th scope="col" style="text-align: center"></th>
                <th scope="col" style="text-align: center"></th>
                <th scope="col" style="text-align: center">وضعیت</th>
                <th scope="col" style="text-align: center">ایمیل</th>
                <th scope="col" style="text-align: center">نام کاربری</th>
                <th scope="col" style="text-align: center">نام خانوادگی</th>
                <th scope="col" style="text-align: center">نام</th>
                <th scope="col" style="text-align: center">#</th>
            </tr>
            </thead>
            <tbody>
            @foreach($result as $r)
                <tr>
                    <td style="text-align: center">
                        <form method="post"
                              action="{{ route('admin.admin_users.delete', ['id' => $hashids->encode($r->id)]) }}">
                            @csrf
                            @method('delete')
                            <button type="submit"
                                    class="btn btn-xs btn-outline-danger btn-flat show_delete"
                                    data-toggle="tooltip" title='Delete'>
                                حذف
                            </button>
                        </form>
                    </td>
                    <td class="text-center">
                        <form method="get"
                              action="{{ route('admin.admin_users.password-change.edit', ['password_change' => $hashids->encode($r->id)]) }}">
                            @csrf
                            <button type="submit"
                                    class="btn btn-xs btn-outline-dark btn-flat password_edit"
                                    data-toggle="tooltip" title='Password Change'>
                                تغییر رمزعبور
                            </button>
                        </form>
                    </td>
                    <td class="text-center">
                        <form method="get"
                              action="{{ route('admin.admin_users.status', ['id' => $hashids->encode($r->id)]) }}">
                            @csrf
                            <button type="submit"
                                    class="btn btn-xs btn-outline-warning btn-flat show_edit"
                                    data-toggle="tooltip" title='Edit'>
                                @if($r->status == 'enabled')
                                    {{ 'فعال' }}
                                @else
                                    {{ 'غیرفعال' }}
                                @endif
                            </button>
                        </form>
                    </td>
                    <td style="text-align: center">{{ $r->email }}</td>
                    <td style="text-align: center">{{ $r->username }}</td>
                    <td style="text-align: center">{{ $r->surname }}</td>
                    <td style="text-align: center">{{ $r->name }}</td>
                    <td style="text-align: center">{{ ++$i }}</td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('js/sweetalert_2.1.0.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}" crossorigin="anonymous"></script>
    <script>
        $('.show_edit').click(function (event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: `آیا از تغییر وضعیت این کاربر ادمین مطمئن هستید؟`,
                text: "تغییر وضعیت موجب قطع دسترسی کاربر می‌گردد",
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
        $('.password_edit').click(function (event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: `آیا از تغییر رمزعبور این کاربر ادمین مطمئن هستید؟`,
                text: 'بعد از تایید این علمیات رمز عبور ساخته شده و فقط نمایش داده می‌شود',
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
        $('.show_delete').click(function (event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: `آیا از حذف کردن این کاربر ادمین اطمینان دارید؟`,
                text: "این عملیات بازگشت ناپذیر خواهد بود",
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
