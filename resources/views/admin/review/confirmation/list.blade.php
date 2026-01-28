@extends('layout.admin_template')
@section('content')
    <div class="container">
        <div class="btn-group float-end m-2" role="group" aria-label="Basic example">
            <a class="btn btn-success text-decoration-none" href="{{ route('admin.review.confirmation.list', ['gender' => 'women']) }}">بانوان</a>
            <a class="btn btn-primary text-decoration-none" href="{{ route('admin.review.confirmation.list', ['gender' => 'men']) }}">آقایان</a>
            نمایش
        </div>


        <table class="table table-hover">
            <thead class="table-dark">
            <tr>
                <th scope="col" style="text-align: center"></th>
                <th scope="col" style="text-align: center">فصل مسابقاتی</th>
                <th scope="col" style="text-align: center">رده</th>
                <th scope="col" style="text-align: center">تیم</th>
                <th scope="col" style="text-align: center">نام خانوادگی</th>
                <th scope="col" style="text-align: center">نام</th>
                <th scope="col" style="text-align: center">#</th>
            </tr>
            </thead>
            <tbody>
            @foreach($list as $l)
                @if($l->list__status_approved == 'done' && $l->list__status_print == 'done')
                    @php
                        $class = 'table-light';
                        $title = 'تایید و چاپ شده';
                    @endphp
                @elseif($l->list__status_approved == 'done' && $l->list__status_print == 'undone')
                    @php
                        $class = 'table-danger';
                        $title = 'تایید شده ولی \' چــاپ \' نشده';
                    @endphp
                @elseif($l->list__status_approved == 'undone' && $l->list__status_print == 'undone' && $l->list__report_defects != null && $l->list__explanation_fixed_defects != null)
                    @php
                        $class = 'table-warning';
                        $title = 'تایید و چاپ نشده، در گزارشی که ارائه شده \' پــاسخی \' دریافت گشته';
                    @endphp
                @elseif($l->list__status_approved == 'undone' && $l->list__status_print == 'undone' && $l->list__report_defects != null)
                    @php
                        $class = 'table-success';
                        $title = 'تایید و چاپ نشده ولــی گزارش ارائه شده';
                    @endphp
                @endif
                <tr class="{{ $class }}" title="{{ $title }}">
                    <td style="text-align: center">
                        <a href="{{ route('admin.review.confirmation.show', ['id' => $hash->encode($l->list__id)]) }}" class="btn btn-outline-dark">تایید</a>
                    </td>
                    <td style="text-align: center">
                        {{ $l->game__name }}
                    </td>
                    <td style="text-align: center"> {{ $l->category__name }} </td>
                    <td style="text-align: center">{{ $l->team__name }}</td>
                    <td style="text-align: center">{{ $l->list__surname }}</td>
                    <td style="text-align: center">{{ $l->list__name }}</td>
                    <td style="text-align: center">{{ ++$i }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $list->links() }}
    </div>
@endsection
