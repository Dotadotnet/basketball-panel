@extends('layout.accounts_template')

@section('content')
    <div class="container px-4 py-5">

        @if(Session::has('message'))
            <div class="row">
                <div class="input-group mb-3 h-100 d-flex align-items-center justify-content-center">
                    <p class="alert alert-success">{{ Session::get('message') }}</p>
                </div>
            </div>
        @endif
        <form
            action="{{ route('dashboard.list.edit', ['seasons_game_id' => $seasons_game_id, 'team_id' => $team_id, 'list_id' => Hashids::encode($list->id)]) }}"
            method="post" enctype="multipart/form-data"
            class="input-group">
            @csrf
            <div class="row">

                <div class="col-1"></div>
                <div class="col-5 justify-content-start">
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="inputGroupFile01" name="photo_case">
                        <label class="input-group-text" for="inputGroupFile01">تصویر عکس</label>
                        @if($list->photo_case)
                            <a class="m-1"
                               href="{{ route('dashboard.image.view', Hashids::encode($list->photo_case)) }}">تصویر</a>
                        @endif
                    </div>
                    @error('photo_case') <span class="error">{{ $message }}</span> @enderror
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="inputGroupFile02" name="photo_identity_card">
                        <label class="input-group-text" for="inputGroupFile02">تصویر شناسنامه</label>
                        @if($list->photo_identity_card)
                            <a class="m-1"
                               href="{{ route('dashboard.image.view', Hashids::encode($list->photo_identity_card)) }}">تصویر</a>
                        @endif
                    </div>
                    @error('photo_identity_card') <span class="error">{{ $message }}</span> @enderror
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="inputGroupFile03" name="photo_national_card">
                        <label class="input-group-text" for="inputGroupFile03">تصویر کارت ملی</label>
                        @if($list->photo_national_card)
                            <a class="m-1"
                               href="{{ route('dashboard.image.view', Hashids::encode($list->photo_national_card)) }}">تصویر</a>
                        @endif
                    </div>
                    @error('photo_national_card') <span class="error">{{ $message }}</span> @enderror
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="inputGroupFile04"
                               name="photo_end_of_military_service">
                        <label class="input-group-text" for="inputGroupFile04">تصویر پایان خدمت</label>
                        @if($list->photo_end_of_military_service)
                            <a class="m-1"
                               href="{{ route('dashboard.image.view', Hashids::encode($list->photo_end_of_military_service)) }}">تصویر</a>
                        @endif
                    </div>
                    @error('photo_end_of_military_service') <span class="error">{{ $message }}</span> @enderror
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="inputGroupFile05"
                               name="photo_enrollment_certificate">
                        <label class="input-group-text" for="inputGroupFile05">تصویر گواهی اشتغال به تحصیل</label>
                        @if($list->photo_enrollment_certificate)
                            <a class="m-1"
                               href="{{ route('dashboard.image.view', Hashids::encode($list->photo_enrollment_certificate)) }}">تصویر</a>
                        @endif
                    </div>
                    @error('photo_enrollment_certificate') <span class="error">{{ $message }}</span> @enderror
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="inputGroupFile06" name="photo_sports_insurance">
                        <label class="input-group-text" for="inputGroupFile06">تصویر کارت بیمه ورزشی</label>
                        @if($list->photo_sports_insurance)
                            <a class="m-1"
                               href="{{ route('dashboard.image.view', Hashids::encode($list->photo_sports_insurance)) }}">تصویر</a>
                        @endif
                    </div>
                    @error('photo_sports_insurance') <span class="error">{{ $message }}</span> @enderror
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="inputGroupFile07" name="photo_contract_page_one">
                        <label class="input-group-text" for="inputGroupFile07">تصویر صفحه اول قرارداد</label>
                        @if($list->photo_contract_page_one)
                            <a class="m-1"
                               href="{{ route('dashboard.image.view', Hashids::encode($list->photo_contract_page_one)) }}">تصویر</a>
                        @endif
                    </div>
                    @error('photo_contract_page_one') <span class="error">{{ $message }}</span> @enderror
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="inputGroupFile08" name="photo_contract_page_two">
                        <label class="input-group-text" for="inputGroupFile08">تصویر صفحه دوم قرارداد</label>
                        @if($list->photo_contract_page_two)
                            <a class="m-1"
                               href="{{ route('dashboard.image.view', Hashids::encode($list->photo_contract_page_two)) }}">تصویر</a>
                        @endif
                    </div>
                    @error('photo_contract_page_two') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="col-1"></div>
                <div class="col-5">
                    @if($list->report_defects != null)
                        <div class="mb-3 alert-danger rounded p-3 justify-content-center float-end">ایرادات: {{ $list->report_defects }}</div>
                    @endif
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" aria-label="Default"
                               aria-describedby="inputGroup-sizing-default" name="name"
                               placeholder="همانند: سید احمد رضا"
                               style="text-align: center" value="{{ $list->name }}">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">نام</span>
                        </div>
                    </div>
                    @error('name') <span class="error">{{ $message }}</span> @enderror
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" aria-label="Default"
                               aria-describedby="inputGroup-sizing-default" name="surname"
                               placeholder="همانند: محمدی منش"
                               style="text-align: center" value="{{ $list->surname }}">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">نام خانوادگی</span>
                        </div>
                    </div>
                    @error('surname') <span class="error">{{ $message }}</span> @enderror
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" aria-label="Default"
                               aria-describedby="inputGroup-sizing-default" name="birthdate"
                               placeholder="همانند: 1374/01/01"
                               style="text-align: center" value="{{ $list->birthdate }}">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">تاریخ تولد</span>
                        </div>
                    </div>
                    @error('birthdate') <span class="error">{{ $message }}</span> @enderror
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" aria-label="Default"
                               aria-describedby="inputGroup-sizing-default" name="nationalCode"
                               placeholder="همانند: 0019558811"
                               style="text-align: center" value="{{ $list->national_code }}">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">کد ملی</span>
                        </div>
                    </div>
                    @error('nationalCode') <span class="error">{{ $message }}</span> @enderror
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" aria-label="Default"
                               aria-describedby="inputGroup-sizing-default" name="identityCode" placeholder="همانند: 34"
                               style="text-align: center" value="{{ $list->identity_code }}">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">شماره شناسنامه</span>
                        </div>
                    </div>
                    @error('identityCode') <span class="error">{{ $message }}</span> @enderror
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" aria-label="Default"
                               aria-describedby="inputGroup-sizing-default" name="cellphone"
                               placeholder="همانند: 09121234567"
                               style="text-align: center" value="{{ $list->cellphone }}">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">شماره موبایل</span>
                        </div>
                    </div>
                    @error('cellphone') <span class="error">{{ $message }}</span> @enderror
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" aria-label="Default"
                               aria-describedby="inputGroup-sizing-default" name="expireContract"
                               placeholder="همانند: 1401" style="text-align: center"
                               value="{{ substr($list->expire_contract, 0, -6) }}">
                        <div class="input-group-prepend me-1">
                            <span class="input-group-text" id="inputGroup-sizing-default">/01/31</span>
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">تاریخ پایان قرارداد</span>
                            </div>
                        </div>
                        @error('expireContract') <span class="error">{{ $message }}</span> @enderror
                        <div class="input-group mb-3">
                            <select class="form-control" id="exampleFormControlSelect1" aria-label="Default"
                                    aria-describedby="inputGroup-sizing-default" name="post">
                                @foreach($post as $p)
                                    <option style="text-align: center"
                                            value="{{ Hashids::encode($p->id) }}"
                                            @if($p->id == $list->post_id) selected @endif>{{ $p->name }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">سمت</span>
                            </div>
                        </div>
                        @error('post') <span class="error">{{ $message }}</span> @enderror
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default" name="tShirtNumber"
                                   placeholder="همانند: 00"
                                   style="text-align: center" value="{{ $list->t_shirt_number }}">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">شماره پیراهن</span>
                            </div>
                        </div>
                        @error('tShirtNumber') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <input class="form-control m-3 btn btn-outline-success rounded-5" type="submit"
                           value="آپدیت اطلاعات">
                    <a href="{{ route('dashboard.team.list', ['id' => $seasons_game_id, 'name_id' => $team_id]) }}"
                       class="form-control m-3 btn btn-primary rounded-5">بازگشت به لیست</a>

                </div>
            </div>
        </form>
    </div>
@endsection
