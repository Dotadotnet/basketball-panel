@extends('layout.admin_template')
@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">
                <!-- عنوان -->
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">

                    <div>
                        <h5 class="fw-bold mb-1">
                            نام تیم : {{ $teamInfo->name }}
                        </h5>
                        <small class="text-muted">
                            فصل مسابقاتی : {{ $info->name }}
                        </small>
                    </div>

                    @if ($info->status == 'notStarted')
                        <span class="d-inline-flex align-items-center gap-2">
                            <span class="rounded-circle bg-warning"
                                style="width:10px; height:10px; display:inline-block;"></span>
                            <span class="fw-semibold text-warning">
                                شروع نشده
                            </span>
                        </span>
                    @elseif($info->status == 'done')
                        <span class="d-inline-flex align-items-center gap-2">
                            <span class="rounded-circle bg-secondary"
                                style="width:10px; height:10px; display:inline-block;"></span>
                            <span class="fw-semibold text-secondary">
                                پایان یافته
                            </span>
                        </span>
                    @elseif($info->status == 'doing')
                        <span class="d-inline-flex align-items-center gap-2">
                            <span class="rounded-circle bg-success"
                                style="width:10px; height:10px; display:inline-block;"></span>
                            <span class="fw-semibold text-success">
                                در حال برگزاری
                            </span>
                        </span>
                    @endif
                </div>

                <hr class="my-4">

                <!-- اطلاعات -->
                <div class="row g-3">

                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded-3 h-100">
                            <small class="text-muted d-block">تعداد افراد</small>
                            <span class="fw-semibold me-2">{{ $list->total() }}</span>
                        </div>
                    </div>

                   
                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded-3 h-100">
                            <small class="text-muted d-block">جنسیت</small>
                            <span class="fw-semibold">
                                {{ $info->gender == 'women' ? 'دختران' : 'پسران' }}
                            </span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded-3 h-100">
                            <small class="text-muted d-block">شناسه تیم</small>
                            <span class="fw-semibold">
                                 {{ $teamInfo->id }}
                            </span>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="fw-bold mb-1">
                            افراد شرکت کننده
                        </h5>
                        <small class="text-muted" id="teamCountInfo"></small>
                    </div>

                    <span class="badge bg-primary rounded-pill" id="teamCountBadge">{{ $list->total() . " " . "نفر" }}</span>
                </div>

               
                <div class="container">


                    <table class="table table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" style="text-align: center">#</th>
                                <th scope="col" style="text-align: center">نام</th>
                                <th scope="col" style="text-align: center">نام خانوادگی</th>
                                <th scope="col" style="text-align: center">کد ملی</th>
                                <th scope="col" style="text-align: center">سمت</th>
                                <th scope="col" style="text-align: center"></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($list as $l)
                                @php
                                    if ($l->list__status_approved == 'done' && $l->list__status_print == 'done') {
                                        $class = 'table-success';
                                        $title = 'تایید و چاپ شده';
                                    } elseif (
                                        $l->list__status_approved == 'done' &&
                                        $l->list__status_print == 'undone'
                                    ) {
                                        $class = 'table-warning';
                                        $title = 'تایید شده ولی چاپ نشده';
                                    } else {
                                        $class = 'table-danger';
                                        $title = 'تایید نشده';
                                    }
                                @endphp
                                <tr class="{{ $class }}" title="{{ $title }}">
                                    <td style="text-align: center">{{ ++$i }}</td>
                                    <td style="text-align: center">{{ $l->list__name }}</td>
                                    <td style="text-align: center"> {{ $l->list__surname }}</td>
                                    <td style="text-align: center"> {{ $l->list__national_code }}</td>
                                    <td style="text-align: center">{{ $l->list__post_name }} </td>
                                    <td style="text-align: center">
                                        <a href="{{ route('admin.review.confirmation.show', ['id' => $hash->encode($l->list__id)]) }}"
                                            class="btn btn-outline-dark">تایید</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div dir="ltr">
                        {{ $list->links() }}
                    </div>
                </div>

            </div>
        </div>
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
