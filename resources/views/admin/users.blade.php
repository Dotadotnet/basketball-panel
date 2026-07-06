@extends('layout.admin_template')
@section('content')
    @php
        if (!function_exists('highlightSearch')) {
            function highlightSearch(string $text, string $search): string
            {
                if (empty($search)) {
                    return $text;
                }

                $words = explode(' ', $search);

                foreach ($words as $word) {
                    if ($word === '') {
                        continue;
                    }
                    // حساس به حروف بزرگ و کوچک نیست
                    $text = str_ireplace(
                        $word,
                        '<span class="text-primary font-weight-bold">' . $word . '</span>',
                        $text,
                    );
                }

                return $text;
            }
        }
    @endphp
    <form method="GET">
        <div class="container px-5 pt-3">
            <!-- Input Search -->
            <div
                style="display: flex;flex-direction: row-reverse; align-items: end;width: 100%;flex-wrap: wrap;justify-content: space-between ;gap: 10px">

                <div style="display: flex;align-items: start;height: 100%;">
                    <a href="{{ route('admin.user.create') }}"
                        class="btn btn-success text-center rounded w-100">ایجاد کاربر جدید +</a>
                </div>

                <div style="display: flex;align-items: center; gap: 10px ; flex-wrap: wrap">


                    <div>

                        <input type="text" value="{{ $search }}" name="search" style="direction: rtl;width: 400px"
                            class="form-control dir-right text-right" placeholder="جستجو ...">
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="container px-4 pb-5">
        <div class="row">
            <div class="col-8"></div>
            <div class="col-4">
            </div>
        </div>
        <div class="row align-items-center g-lg-5 py-5">
            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col" class="text-center">نام</th>
                            <th scope="col" class="text-center">نام خانوادگی</th>
                            <th scope="col" class="text-center">ایمیل</th>
                            <th scope="col" class="text-center">شماره تلفن</th>
                            <th scope="col" class="text-center">رمز عبور</th>
                            <th scope="col" class="text-center">تغییر</th>
                            <th scope="col" class="text-center">حذف</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $l)
                            <tr>
                                <td class="text-center">{{ ++$i }}</td>
                                <td class="text-center">{!! highlightSearch($l->name, $search) !!}</td>
                                <td class="text-center">{!! highlightSearch($l->surname, $search) !!}</td>
                                <td class="text-center">{!! highlightSearch($l->email, $search) !!}</td>
                                <td class="text-center">{!! isset($l->cellphone) ? highlightSearch($l->cellphone, $search) : $l->cellphone !!}</td>
                                <td class="text-center">{!! highlightSearch($l->password, $search) !!}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.user.edit', ['id' => $l->id]) }}" type="submit"
                                        class="btn btn-xs btn-outline-primary btn-flat show_edit" data-toggle="tooltip"
                                        title='Edit'>ویرایش
                                    </a>
                                </td>
                                <td class="text-center">
                                    <form method="POST" action="{{ route('admin.user.destroy', ['id' => $l->id]) }}">
                                        @csrf
                                        @method('delete')
                                        <button data-name="{{ $l->name }}" data-surname="{{ $l->surname }}"
                                            type="submit" class="btn btn-xs btn-outline-danger btn-flat show_delete"
                                            data-toggle="tooltip" title='Delete'>حذف
                                        </button>
                                    </form>
                                </td>
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
        $('.show_delete').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            var surname = $(this).data("surname");
            event.preventDefault();
            swal({
                    title: `آیا از حذف کردن  ${ name + " " + surname } اطمینان دارید؟`,
                    text: "اگر این را حذف کنید برای همیشه از بین خواهد رفت و بازگردانی اطلاعات مرتبط به آن ( تیم‌ها، لیست صورت اسامی و ... ) ممکن نخواهد بود",
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

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form[method~=GET]');
            const selects = form.querySelectorAll('select');
            selects.forEach(function(select) {
                select.addEventListener('change', function() {
                    form.submit();
                });
            });
        });
    </script>
@endsection
