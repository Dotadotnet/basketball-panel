@extends('layout.admin_template')
@section('content')
    <style>
        table * {
            direction: ltr !important;
            text-align: left !important
        }

        td {
            display: inline-flexbox;
            justify-content: center;
            align-items: center
        }
    </style>
    <div class="container mt-5" dir="rtl">
        <div class="row mt-1">
            <div class="col-5 mt-1 pt-3 me-1 border rounded">
                <p>آیدی: {{ $list->id }}</p>
                <p>نام: {{ $list->name }}</p>
                <p>نام خانوادگی: {{ $list->surname }}</p>
                <p>تاریخ تولد: {{ $list->birthdate }}</p>
                <p>شناسنامه: {{ $list->identity_code }}</p>
                <p>کد ملی: {{ $list->national_code }}</p>
                <p>شماره همراه: {{ $list->cellphone }}</p>
            </div>
            <div class="col-1"></div>
            <div class="col-5 mt-1 pt-3 border rounded">
                <p>شماره پیراهن: {{ $list->t_shirt_number ? $list->t_shirt_number : 'ندارد' }}</p>
                <p>سمت:
                    @foreach ($post as $p)
                        @if ($p->id == $list->post_id)
                            {{ $p->name }}
                        @endif
                    @endforeach
                </p>
                <p>تاریخ اتمام قرارداد: {{ $list->expire_contract }}</p>
                <p>تیم:
                    @foreach ($team as $t)
                        @if ($t->id == $list->team_name_id)
                            {{ $t->name }}
                        @endif
                    @endforeach
                </p>
                <p>رده:
                    @foreach ($category as $c)
                        @if ($c->id == $list->game_season_id)
                            {{ $c->name }}
                        @endif
                    @endforeach
                </p>
                <p>فصل مسابقاتی:
                    @foreach ($season as $s)
                        @if ($s->id == $list->game_season_id)
                            {{ $s->name }}
                        @endif
                    @endforeach
                </p>
            </div>
        </div>
    
        <div class="row mt-1">
            <div class="col-12 mt-3 mb-5">
                <div class="border rounded col-1 d-inline-block">
                    <a class="text-decoration-none"
                        href="@if (!is_null($list->photo_case)) {{ route('admin.image.view', ['id' => $hash->encode($list->photo_case)]) }} @else # @endif"><img
                            src="@if (!is_null($list->photo_case)) {{ route('admin.image.view', ['id' => $hash->encode($list->photo_case)]) }} @else # @endif"
                            alt="عکس" title="عکس" width="100" height="100">
                        <p class="text-muted">عکس</p>
                    </a>
                </div>
                <div class="border rounded col-1 d-inline-block">
                    <a class="text-decoration-none"
                        href="@if (!is_null($list->photo_identity_card)) {{ route('admin.image.view', ['id' => $hash->encode($list->photo_identity_card)]) }} @else # @endif"><img
                            src="@if (!is_null($list->photo_identity_card)) {{ route('admin.image.view', ['id' => $hash->encode($list->photo_identity_card)]) }} @else # @endif"
                            alt="شناسنامه" title="شناسنامه" width="100" height="100">
                        <p class="text-muted">شناسنامه</p>
                    </a>
                </div>
                <div class="border rounded col-1 d-inline-block">
                    <a class="text-decoration-none"
                        href="@if (!is_null($list->photo_national_card)) {{ route('admin.image.view', ['id' => $hash->encode($list->photo_national_card)]) }} @else # @endif"><img
                            src="@if (!is_null($list->photo_national_card)) {{ route('admin.image.view', ['id' => $hash->encode($list->photo_national_card)]) }} @else # @endif"
                            alt="کارت ملی" title="کارت ملی" width="100" height="100">
                        <p class="text-muted">کارت ملی</p>
                    </a>
                </div>
                <div class="border rounded col-1 d-inline-block">
                    <a class="text-decoration-none"
                        href="@if (!is_null($list->photo_end_of_military_service)) {{ route('admin.image.view', ['id' => $hash->encode($list->photo_end_of_military_service)]) }} @else # @endif"><img
                            src="@if (!is_null($list->photo_end_of_military_service)) {{ route('admin.image.view', ['id' => $hash->encode($list->photo_end_of_military_service)]) }} @else # @endif"
                            alt="کارت پایان خدمت" title="کارت پایان خدمت" width="100" height="100">
                        <p class="text-muted">کارت پایان خدمت</p>
                    </a>
                </div>
                <div class="border rounded col-1 d-inline-block">
                    <a class="text-decoration-none"
                        href="@if (!is_null($list->photo_enrollment_certificate)) {{ route('admin.image.view', ['id' => $hash->encode($list->photo_enrollment_certificate)]) }} @else # @endif"><img
                            src="@if (!is_null($list->photo_enrollment_certificate)) {{ route('admin.image.view', ['id' => $hash->encode($list->photo_enrollment_certificate)]) }} @else # @endif"
                            alt="گواهی اشتفال" title="گواهی اشتفال" width="100" height="100">
                        <p class="text-muted">گواهی اشتفال</p>
                    </a>
                </div>
                <div class="border rounded col-1 d-inline-block">
                    <a class="text-decoration-none"
                        href="@if (!is_null($list->photo_sports_insurance)) {{ route('admin.image.view', ['id' => $hash->encode($list->photo_sports_insurance)]) }} @else # @endif"><img
                            src="@if (!is_null($list->photo_sports_insurance)) {{ route('admin.image.view', ['id' => $hash->encode($list->photo_sports_insurance)]) }} @else # @endif"
                            alt="بیمه" title="بیمه" width="100" height="100">
                        <p class="text-muted">بیمه</p>
                    </a>
                </div>
                <div class="border rounded col-1 d-inline-block">
                    <a class="text-decoration-none"
                        href="@if (!is_null($list->photo_contract_page_one)) {{ route('admin.image.view', ['id' => $hash->encode($list->photo_contract_page_one)]) }} @else # @endif"><img
                            src="@if (!is_null($list->photo_contract_page_one)) {{ route('admin.image.view', ['id' => $hash->encode($list->photo_contract_page_one)]) }} @else # @endif"
                            alt="صفحه اول قرارداد" title="صفحه اول قرارداد" width="100" height="100">
                        <p class="text-muted">صفحه اول قرارداد</p>
                    </a>
                </div>
                <div class="border rounded col-1 d-inline-block">
                    <a class="text-decoration-none"
                        href="@if (!is_null($list->photo_contract_page_two)) {{ route('admin.image.view', ['id' => $hash->encode($list->photo_contract_page_two)]) }} @else # @endif"><img
                            src="@if (!is_null($list->photo_contract_page_two)) {{ route('admin.image.view', ['id' => $hash->encode($list->photo_contract_page_two)]) }} @else # @endif"
                            alt="صفحه دوم قرارداد" title="صفحه دوم قرارداد" width="100" height="100">
                        <p class="text-muted">صفحه دوم قرارداد</p>
                    </a>
                </div>
                <div class="border rounded col-1 d-inline-block">
                    <a class="text-decoration-none"
                        href="@if (!is_null($list->photo_coaching_card)) {{ route('admin.image.view', ['id' => $hash->encode($list->photo_coaching_card)]) }} @else # @endif"><img
                            src="@if (!is_null($list->photo_coaching_card)) {{ route('admin.image.view', ['id' => $hash->encode($list->photo_coaching_card)]) }} @else # @endif"
                            alt="کارت مربیگری" title="کارت مربیگری" width="100" height="100">
                        <p class="text-muted">کارت مربیگری</p>
                    </a>
                </div>
            </div>
        </div>
        <div class="row mt-1">
            @if (Session::has('message'))
                <p class="alert alert-info text-center">{!! Session::get('message') !!}</p>
            @endif
            <div class="col-12">
                <a class="text-decoration-none btn btn-outline-dark p-2"
                    href="{{ route('admin.review.confirmation.precheck', ['id' => $hash->encode($list->id)]) }}">بـررسـی
                    اولـیـه</a>
                <a class="text-decoration-none btn btn-success p-2 me-5"
                    href="{{ route('admin.review.confirmation.approve', ['id' => $hash->encode($list->id)]) }}">تـایـیـد</a>
                {{--                <a class="text-decoration-none btn btn-danger p-2 me-5" href="#">گــزارش</a> --}}
                <a type="button" class="text-decoration-none btn btn-danger p-2 me-5" data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop">گــزارش</a>
                <a class="text-decoration-none btn btn-primary p-2 me-5"
                    href="{{ route('admin.review.confirmation.print', ['id' => $hash->encode($list->id)]) }}">چــاپ</a>
                <a class="text-decoration-none btn btn-primary p-2 me-5"
                    href="{{ route('admin.team.list.edit', ['id' => $list->game_season_id, 'name_id' => $list->team_name_id, 'list_id' => Hashids::encode($list->id)]) }}">بازکردن
                    ویرایش کاربر</a>
            </div>

            <!-- Modal -->
            <div class="modal fade float-end" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            <h5 class="modal-title" id="staticBackdropLabel">ثبت سریع گزارش</h5>
                        </div>
                        <form
                            action="{{ route('admin.review.confirmation.report.store', ['id' => $hash->encode($list->id)]) }}"
                            method="post">
                            @csrf
                            <div class="modal-body">

                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">پیام:</label>
                                    <textarea class="form-control" id="message-text" name="report">{{ $list->report_defects }}</textarea>
                                    @if ($list->report_defects != null)
                                        <p class="text-muted">این گزارش در تاریخ
                                            {{ Verta(strtotime($list->report_defects_at))->format('H:i ; Y/m/d') }} تهیه
                                            شده</p>
                                    @endif
                                    @error('report')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary" value="ارسـال">
                                <a class="btn btn-danger"
                                    href="{{ route('admin.review.confirmation.report.delete', ['id' => $hash->encode($list->id)]) }}">حـذف</a>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بـسـتـن</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
            @php
            $user_id = isset($list->accounts_id)
                ? $list->accounts_id
                : \Illuminate\Support\Facades\Auth::guard('user')->id();
            $history = \Illuminate\Support\Facades\DB::table('list_of_team_names')
                ->join('teams_posts', 'list_of_team_names.post_id', '=', 'teams_posts.id')
                ->join('teams_names', 'list_of_team_names.team_name_id', '=', 'teams_names.id')
                ->join('teams_game_seasons', 'list_of_team_names.game_season_id', '=', 'teams_game_seasons.id')
                ->select(
                    'list_of_team_names.*',
                    'teams_posts.name as post_name',
                    'teams_names.name as team_name',
                    'teams_game_seasons.name as seasons_name',
                )
                ->orderByDesc('id')
                ->where('national_code', '=', $list->national_code)
                ->get();
        @endphp
        @if (!$history->isEmpty())
            <div class="container px-5 pt-5 table-div">
                <h3 style="margin: 10px 40px 40px 10px">فعالیت های قبلی :</h3>
                <div style="max-height: 400px ; overflow-y: auto">
                    <table class="table table-striped text-center table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">تیم</th>
                                <th scope="col">رده</th>
                                <th scope="col">سمت</th>
                                <th scope="col">شماره پیراهن</th>
                                <th scope="col">ثبت نهایی</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = count($history); @endphp

                            @foreach ($history as $l)
                                <tr>
                                    <td>{{ $i}}</td>
                                    <td>{{ $l->team_name }}</td>
                                    <td>{{ $l->seasons_name }}</td>
                                    <td>
                                        {{ $l->post_name }}
                                    </td>
                                    <td>{{ $l->t_shirt_number }}</td>
                                    <td>
                                        @if ($l->status_user_submit == 'undone')
                                            {{ 'انجام نشده' }}
                                        @else
                                            {{ 'انجام گردید' }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.review.confirmation.show', ['id' => $hash->encode($list->id)]) }}"
                                            class="btn btn-outline-dark">مشاهده</a>
                                    </td>
                                </tr>
                                @php
                                     $i--
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
    <br>
@endsection
