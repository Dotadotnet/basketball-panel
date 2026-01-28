@extends('layout.admin_template')
@section('content')
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        <form dir="rtl" class="m-0" method="post"
              action="{{ route('admin.setting.game_season.update', ['id' => $hash->encode($data->id)]) }}">
            @csrf
            <div class="row">
                <div class="col-2"></div>
                <div class="col-4">
                    <div class="m-2">
                        <label for="name" class="form-label float-end">نام فصل</label>
                        <input class="form-control" type="text" name="name" id="name" value="{{ $data->name }}">
                    </div>
                    @error('name') <p class="text-danger">{{ $message }}</p> @enderror

                    <div class="m-2">
                        <label for="date" class="form-label float-end">تاریخ</label>
                        <input class="form-control" type="text" name="date" id="date"
                               placeholder="{{ \Hekmatinasser\Verta\Verta::now()->format('Y/m/d') }}" value="{{ $data->date }}">
                    </div>
                    @error('date') <p class="text-danger">{{ $message }}</p> @enderror

                    <div class="m-2">
                        <label for="category_id" class="form-label float-end">رده مسابقات</label>
                        <select class="form-select text-center" aria-label="Default select example" name="category_id"
                                id="category_id">
                            @foreach($category as $c)
                                <option value="{{ Hashids::encode($c->id) }}" @if($data->category_id == $c->id) selected @endif>{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('category_id') <p class="text-danger">{{ $message }}</p> @enderror

                    <div class="m-2">
                        <label for="teams_allowed_age_id" class="form-label float-end">سن مجاز</label>
                        <select class="form-select text-center" aria-label="Default select example"
                                name="teams_allowed_age_id" id="teams_allowed_age_id">
                            @foreach($allowAge as $a)
                                <option value="{{ Hashids::encode($a->id) }}" @if($data->teams_allowed_age_id == $a->id) selected @endif>{{ $a->date }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('teams_allowed_age_id') <p class="text-danger">{{ $message }}</p> @enderror
                    <div class="m-2 mt-3">
                        <input class="form-control btn btn-outline-success" type="submit" value="ویــرایــش کــردن">
                    </div>
                </div>


                <div class="col-4">
                    <div class="m-2">
                        <label for="status" class="form-label float-end">وضعیت</label>
                        <select class="form-select text-center" aria-label="Default select example" name="status" value="{{ $data->status }}"
                                id="status">
                            <option value="doing">درحال انجام</option>
                            <option value="done">برگزار شده</option>
                            <option value="notStarted" selected>شروع نشده</option>
                        </select>
                    </div>
                    @error('status') <p class="text-danger">{{ $message }}</p> @enderror

                    <div class="m-2">
                        <label for="gender" class="form-label float-end">جنسیت</label>
                        <select class="form-select text-center" aria-label="Default select example" name="gender"
                                id="gender">
                            <option value="men" @if($data->gender == 'men') selected @endif>آقا</option>
                            <option value="women" @if($data->gender == 'women') selected @endif>خانم</option>
                        </select>
                    </div>
                    @error('gender') <p class="text-danger">{{ $message }}</p> @enderror
{{--                    {{ dd($data->start_time_at) }}--}}
                    <div class="m-2">
                        <label for="start_time_at" class="form-label float-end">زمان شروع ورود اطلاعات</label>
                        <input class="form-control text-center" aria-label="Default select example" name="start_time_at" value="{{ $jalali->reverseGregorianToJalali($data->start_time_at) }}"
                               id="start_time_at" dir="ltr"
                               placeholder="{{ \Hekmatinasser\Verta\Verta::now()->format('Y/m/d H:i:s') }} همانند">
                    </div>
                    @error('start_time_at') <p class="text-danger">{{ $message }}</p> @enderror

                    <div class="m-2">
                        <label for="finish_time_at" class="form-label float-end">زمان اتمام ورود اطلاعات</label>
                        <input class="form-control text-center" aria-label="Default select example" dir="ltr"
                               name="finish_time_at" value="{{ $jalali->reverseGregorianToJalali($data->finish_time_at) }}"
                               id="finish_time_at"
                               placeholder="{{ \Hekmatinasser\Verta\Verta::now()->format('Y/m/d H:i:s') }} همانند">
                    </div>
                    @error('finish_time_at') <p class="text-danger">{{ $message }}</p> @enderror
                    <div class="m-2 mt-3">
                        <a href="{{ route('admin.setting.game_season.list') }}" class="form-control btn btn-outline-primary">بازگشت به لیست</a>
                    </div>

                </div>
                <div class="col-2"></div>
            </div>
        </form>
    </div>
@endsection
