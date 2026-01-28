@extends('layout.accounts_template')

@section('content')
    <div class="container px-4 py-5">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-5">
                <div class="input-group mb-3">
                    <input type="file" class="form-control" id="inputGroupFile01" name="photoCase">
                    <label class="input-group-text" for="inputGroupFile01">تصویر عکس</label>
                    @error('photoCase') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="file" class="form-control" id="inputGroupFile01" name="photoIdentityCard">
                    <label class="input-group-text" for="inputGroupFile01">تصویر شناسنامه</label>
                    @error('photoIdentityCard') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="file" class="form-control" id="inputGroupFile01" name="photoNationalCard">
                    <label class="input-group-text" for="inputGroupFile01">تصویر کارت ملی</label>
                    @error('photoNationalCard') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="file" class="form-control" id="inputGroupFile01" name="photoEndOfMilitaryService">
                    <label class="input-group-text" for="inputGroupFile01">تصویر پایان خدمت</label>
                    @error('photoEndOfMilitaryService') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="file" class="form-control" id="inputGroupFile01" name="photoEnrollmentCertificate">
                    <label class="input-group-text" for="inputGroupFile01">تصویر گواهی اشتغال به تحصیل</label>
                    @error('photoEnrollmentCertificate') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="file" class="form-control" id="inputGroupFile01" name="photoSportsInsurance">
                    <label class="input-group-text" for="inputGroupFile01">تصویر کارت بیمه ورزشی</label>
                    @error('photoSportsInsurance') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="file" class="form-control" id="inputGroupFile01" name="photoContractPageOne">
                    <label class="input-group-text" for="inputGroupFile01">تصویر صفحه اول قرارداد</label>
                    @error('photoContractPageOne') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="file" class="form-control" id="inputGroupFile01" name="photoContractPageTwo">
                    <label class="input-group-text" for="inputGroupFile01">تصویر صفحه دوم قرارداد</label>
                    @error('photoContractPageTwo') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-1"></div>
            <div class="col-5">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="name" placeholder="سید احمد رضا" style="text-align: center">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">نام</span>
                    </div>
                    @error('name') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="surname" placeholder="محمدی منش" style="text-align: center">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">نام خانوادگی</span>
                    </div>
                    @error('surname') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="birthdate" placeholder="1374/01/01" style="text-align: center">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">تاریخ تولد</span>
                    </div>
                    @error('birthdate') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="nationalCode" placeholder="0019558811" style="text-align: center">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">کد ملی</span>
                    </div>
                    @error('nationalCode') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="IdentityCode" placeholder="34" style="text-align: center">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">شماره شناسنامه</span>
                    </div>
                    @error('IdentityCode') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="cellphone" placeholder="09121234567" style="text-align: center">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">شماره موبایل</span>
                    </div>
                    @error('cellphone') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="expireContract" placeholder="1401/01/01" style="text-align: center">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">تاریخ پایان قرارداد</span>
                    </div>
                    @error('expireContract') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="input-group mb-3">
                    <select class="form-control" id="exampleFormControlSelect1" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="post">
                        @foreach($post as $p)
                            <option style="text-align: center" value="{{ Hashids::encode($p->id) }}">{{ $p->name }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">سمت</span>
                    </div>
                    @error('post') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="tShirtNumber" placeholder="00" style="text-align: center">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">شماره پیراهن</span>
                    </div>
                    @error('tShirtNumber') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
    </div>
@endsection
