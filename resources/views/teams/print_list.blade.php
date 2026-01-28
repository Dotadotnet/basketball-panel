<!doctype html>
<html lang="fa">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>لیست چاپی</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/print-list.css') }}">
    <style>
        @font-face {
            font-family: IRANSansX;
            font-style: normal;
            font-weight: 700;
            src: url("{{ asset('fonts/woff/IRANSansX-Bold.woff') }}") format('woff'),
        url("{{ asset('fonts/woff2/IRANSansX-Bold.woff2') }}") format('woff2');
        }

        @font-face {
            font-family: IRANSansX;
            font-style: normal;
            font-weight: 400;
            src: url("{{ asset('fonts/woff/IRANSansX-Regular.woff') }}") format('woff'),
        url("{{ asset('fonts/woff2/IRANSansX-Regular.woff2') }}") format('woff2');
        }
    </style>
</head>
<body>
<div class="print-list">
    <div class="header">
        <img src="{{ public_path('images/heyaat-logo.jpeg') }}">
        <div class="title">هیات بسکتبال استان تهران</div>
        <div class="description">
            فرم اطلاعات بازیکنان تیم بسکتبـال باشگاه «<strong>{{ $list[0]->teams[0]['name'] }}</strong>» رده سنـی  «<strong>{{ $list[0]->game_season[0]->categories[0]['name'] }}</strong>» سـال <strong>{{substr($list[0]->game_season[0]['date'], 0, 4)}}</strong>
        </div>
    </div>
    <table>
        <tr>
            <th>شماره پیراهن</th>
            <th>اتمام قرارداد</th>
            <th>کد ملی</th>
            <th>شماره همراه</th>
            <th>تاریخ تولد</th>
            <th>نام خانوادگی</th>
            <th>نام</th>
            <th>ردیف</th>
        </tr>
        @foreach($list as $l)
            <tr>
                <td>{{ $l->t_shirt_number }}</td>
                <td>{{ $l->expire_contract }}</td>
                <td>{{ $l->national_code }}</td>
                <td>{{ $l->cellphone }}</td>
                <td>{{ $l->birthdate }}</td>
                <td>{{ $l->surname }}</td>
                <td>{{ $l->name }}</td>
                <td>{{ ++$i }}</td>
            </tr>
        @endforeach
    </table>
<div class="print-list date">{{ verta()->format('Y/n/j') }} :تاریخ چاپ</div>
</div>
<div class="pagebreak"></div>
@for($x=0; $x < (15-$i); $x++)
    <div class="br"></div>
@endfor
<div class="print-list">
    <div class="header">
        <img src="{{ public_path('images/heyaat-logo.jpeg') }}">
        <div class="title">هیات بسکتبال استان تهران</div>
        <div class="description">
            فرم اطلاعات کادرفنی تیم بسکتبـال باشگاه «<strong>{{ $list[0]->teams[0]['name'] }}</strong>» رده سنـی  «<strong>{{ $list[0]->game_season[0]->categories[0]['name'] }}</strong>» سـال <strong>{{substr($list[0]->game_season[0]['date'], 0, 4)}}</strong>
        </div>
    </div>
    <table>
        <tr>
            <th>تلفن همراه</th>
            <th>سمت</th>
            <th>کد ملی</th>
            <th>محل تولد</th>
            <th>تاریخ تولد</th>
            <th>نام خانوادگی</th>
            <th>نام</th>
            <th>ردیف</th>
        </tr>
        @foreach($list_back as $l)
            <tr>
                <td>{{ $l->cellphone }}</td>
                <td>{{ $l->post[0]['name'] }}</td>
                <td>{{ $l->national_code }}</td>
                <td></td>
                <td>{{ $l->birthdate }}</td>
                <td>{{ $l->surname }}</td>
                <td>{{ $l->name }}</td>
                <td>{{ ++$i }}</td>
            </tr>
        @endforeach
    </table>
    <div class="print-list footer">
        <div class="row">
            <div class="phone-number">:تلفن باشگاه</div>
            <div class="fax">:فکس</div>
            <div class="name-owner-team">:نام و نام خانوادگی مدیر باشگاه</div>
        </div>
        <div class="row-half"></div>
        <div class="row">
            <div class="email">:ایمیل</div>
            <div class="signature">
                .صحت مدارک و مشخصات ارائه شده به کمیته مسابقات مورد تایید می‌باشد
            </div>
        </div>
        <div class="row">
            <div class="signature split">
                مهر و امضاء مدیر باشگاه
            </div>
        </div>
    </div>
    <div class="print-list date">{{ verta()->format('Y/n/j') }} :تاریخ چاپ</div>
</div>
</body>
</html>
