@extends('layout.accounts_template')

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
                <a href="{{ route('dashboard.my_club.create') }}" class="btn btn-success text-center mb-3 rounded w-100">ایــجــاد +</a>
            </div>
        </div>
        <table class="table table-hover">
            <thead class="table-dark">
            <tr>
                <th scope="col" style="text-align: center"></th>
                <th scope="col" style="text-align: center">شماره تلفن</th>
                <th scope="col" style="text-align: center">آدرس</th>
                <th scope="col" style="text-align: center">نام باشگاه</th>
                <th scope="col" style="text-align: center">#</th>
            </tr>
            </thead>
            <tbody>
            @foreach($res as $r)
                <tr>
                    <td style="text-align: center">
                        <form method="post"
                              action="{{ route('dashboard.my_club.destroy', ['my_club' => $hashids->encode($r->id)]) }}">
                            @csrf
                            @method('delete')
                            <button type="submit"
                                    class="btn btn-xs btn-outline-danger btn-flat show_delete"
                                    data-toggle="tooltip" title='Delete'>
                                حذف
                            </button>
                        </form>
                    </td>
                    <td style="text-align: center">{{ $r->name }}</td>
                    <td style="text-align: center">
                        @if(strlen($r->address) > 18)
                            {{ substr($r->address, 0, 18) . '...' }}
                        @else
                            {{ $r->address }}
                        @endif
                    </td>
                    <td style="text-align: center">{{ $r->number_phone }}</td>
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

        $('.show_delete').click(function (event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: `آیا از حذف کردن این باشگاه اطمینان دارید؟`,
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

