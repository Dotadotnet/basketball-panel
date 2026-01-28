@extends('layout.admin_template')

@section('content')
    <div dir="ltr" class="container col-xl-10 col-xxl-9">
        <div class="row align-items-center">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">وضعیت</th>
                    <th scope="col">تاریخ پرداختی</th>
                    <th scope="col">فیش</th>
                    <th scope="col">نام خانوادگی</th>
                    <th scope="col">نام</th>
                    <th scope="col">#</th>
                </tr>
                </thead>
                <tbody>
                @foreach($payments as $p)
                    <tr>
                        <td>
                            <form method="POST" action="{{ route('admin.payment.delete', ['id' => Hashids::encode($p->id)]) }}">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit"
                                        class="btn btn-xs btn-outline-danger btn-flat show_delete"
                                        data-toggle="tooltip" title='Delete'>حذف
                                </button>
                            </form>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('admin.payment.confirm', ['id' => Hashids::encode($p->id)]) }}">
                                @csrf
                                <button type="submit"
                                        class="btn btn-xs btn-outline-success btn-flat show_confirm"
                                        data-toggle="tooltip" title='Accept'>تایید
                                </button>
                            </form>
                        </td>
                        <td>
                            @if($p->status == 'awaitingReview')
                                {{ 'در انتظار بررسی' }}
                            @elseif($p->status == 'correct')
                                {{ 'تایید شد' }}
                            @else
                                {{ 'رد شد' }}
                            @endif
                        </td>
                        <td>{{ $p->date }}</td>
                        <td><a href="{{ route('admin.image.view', Hashids::encode($p->files_id)) }}">لینک</a></td>
                        <td>{{ $p->accounts->surname }}</td>
                        <td>{{ $p->accounts->name }}</td>
                        <td>{{ ++$i }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $payments->links() }}
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
                title: `آیا از حذف کردن این فیش لیست اطمینان دارید؟`,
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
        $('.show_confirm').click(function (event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: `آیا از تایید این فیش مطمئن هستید؟`,
                text: "پس از تایید امکان ورود اطلاعات تیم مربوطه میسر خواهد شد",
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
