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
    <div class="container">
        <form method="GET">
            <div class="container p-3">
                <!-- Input Search -->
                <div
                    style="display: flex;align-items: center;width: 100%;flex-wrap: wrap;justify-content: space-between ;gap: 10px;flex-direction: row-reverse">

                    <div>
                        <button type="submit" class="btn btn-primary">اعمال</button>

                    </div>

                    <div style="display: flex;align-items: center; ;gap: 10px ; flex-wrap: wrap">
                        <div class="mr-4">
                            <select name="gender" style="width: 200px" dir="rtl" class="form-select">
                                <option value="" {{ $gender == '' ? 'selected' : '' }}>انتخاب کنید</option>
                                <option value="men" {{ $gender == 'men' ? 'selected' : '' }}>آقایان</option>
                                <option value="women" {{ $gender == 'women' ? 'selected' : '' }}>بانوان</option>
                            </select>
                        </div>

                        <div>

                            <input type="text" value="{{ $search }}" name="search"
                                style="direction: rtl;width: 400px" class="form-control dir-right text-right"
                                placeholder="جستجو ...">
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col" style="text-align: center">#</th>
                    <th scope="col" style="text-align: center">نام</th>
                    <th scope="col" style="text-align: center">نام خانوادگی</th>
                    <th scope="col" style="text-align: center">کد ملی</th>
                    <th scope="col" style="text-align: center">تیم</th>
                    <th scope="col" style="text-align: center">فصل مسابقاتی</th>
                    <th scope="col" style="text-align: center"></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($list as $l)
                    @php
                        if ($l->list__status_approved == 'done' && $l->list__status_print == 'done') {
                            $class = 'table-success';
                            $title = 'تایید و چاپ شده';
                        } elseif ($l->list__status_approved == 'done' && $l->list__status_print == 'undone') {
                            $class = 'table-warning';
                            $title = 'تایید شده ولی چاپ نشده';
                        } else {
                              $class = 'table-danger';
                            $title = 'تایید نشده';
                        }
                    @endphp
                    <tr class="{{ $class }}" title="{{ $title }}">
                        <td style="text-align: center">{{ ++$i }}</td>
                        <td style="text-align: center">{!! highlightSearch($l->list__name, $search) !!}</td>
                        <td style="text-align: center"> {!! highlightSearch($l->list__surname, $search) !!} </td>
                        <td style="text-align: center"> {!! highlightSearch($l->list__national_code, $search) !!} </td>
                        <td style="text-align: center"> {!! highlightSearch($l->category__name, $search) !!} </td>
                        <td style="text-align: center">{!! highlightSearch($l->game__name, $search) !!} </td>
                        <td style="text-align: center">
                            <a href="{{ route('admin.review.confirmation.show', ['id' => $hash->encode($l->list__id)]) }}"
                                class="btn btn-outline-dark">تایید</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $list->links() }}
    </div>
    <script>
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
