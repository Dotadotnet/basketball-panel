@php
    $user = Auth::guard('user')->user();
    $imageUser = asset('images/user_def.jpg');
    $nameUser = $user->name . ' ' . $user->surname;
    $rollUser = 'بازیکن';

    $last = \Illuminate\Support\Facades\DB::table('list_of_team_names')
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
        ->where('accounts_id', '=', $user->id)
        ->get()
        ->first();
    if ($last) {
        $rollUser = $last->post_name;
    }
    $last = \Illuminate\Support\Facades\DB::table('list_of_team_names')
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
        ->where('accounts_id', '=', $user->id)
        ->where('photo_case', '!=', null)
        ->get()
        ->first();
    if ($last) {
        $imageUser = route('dashboard.image.view', ['id' => Hashids::encode($last->photo_case)]);
    }
@endphp
<aside style="z-index: 102" class="sidebar">
    <div class="sidebar-start">
        <div class="sidebar-head">
            <a href="/" class="logo-wrapper" title="Home">
                <span class="sr-only">Home</span>
                {{-- <span class="icon logo" aria-hidden="true"></span> --}}
                <img style="width: 40px" src="{{ asset('images/logo4.png') }}" alt="">
                <div class="logo-text">
                    <span style="font-size: 11px" class="logo-title mr-5 relative font-parastoo">فدارسیون <span
                            class=" text-xs absolute -top-2 -right-2">بسکتبال</span></span>
                    <span style="font-size: 9px" class="logo-subtitle mr-5 font-parastoo font-bold">حساب کاربری</span>
                </div>

            </a>
            <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
                <span class="sr-only">Toggle menu</span>
                <span class="icon menu-toggle" aria-hidden="true"></span>
            </button>
        </div>
        <div class="sidebar-body">
            <ul class="sidebar-body-menu">
                <li>
                    <a href="/dashboard"><span class="icon home" aria-hidden="true"></span>داشبورد</a>
                </li>
                <li>
                    <a href="/dashboard/seasons"><span class="icon document" aria-hidden="true"></span>ورود اطلاعات</a>
                </li>
                <li>
                    <a href="/dashboard/payment"><span class="icon document" aria-hidden="true"></span>پرداختی ها</a>
                </li>
                <li>
                    <a href="/dashboard/my-club"><span class="icon home" aria-hidden="true"></span>آدرس فعالیت
                        باشگاه</a>
                </li>
                {{-- <li>
                    <a href="/panel/comment">
                        <span class="icon message" aria-hidden="true"></span>
                        کامنت ها
                    </a>
                    <span class="msg-counter comment-show"> {{ count(App\Models\Comment::where(['status' => 0])->get())  }} </span>
                </li> --}}
            </ul>

            {{-- <ul class="sidebar-body-menu d-none">
                <li>
                    <a href="appearance.html"><span class="icon edit" aria-hidden="true"></span>Appearance</a>
                </li>
                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon category" aria-hidden="true"></span>Extentions
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="extention-01.html">Extentions-01</a>
                        </li>
                        <li>
                            <a href="extention-02.html">Extentions-02</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon user-3" aria-hidden="true"></span>کاربران
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="">کاربران فعال</a>
                        </li>
                        <li>
                            <a href="">کاربران مسدود شده</a>
                        </li>
                    </ul>
                </li>
               
                <li>
                    <a href="##"><span class="icon setting" aria-hidden="true"></span>Settings</a>
                </li>
            </ul> --}}
        </div>
    </div>
    <div class="sidebar-footer">
        <a href="##" class="sidebar-user">
            <span class="sidebar-user-img">
                <picture>
                    <img src="{{ $imageUser }}" alt="User name">
                </picture>
            </span>
            <div class="sidebar-user-info ">
                <span style="padding-right: 5px" class="sidebar-user__title pr-3">
                    {{ $nameUser }}
                </span>
                <span style="padding-right: 5px" class="sidebar-user__subtitle pr-3 mt-1 font-parastoo">
                    {{ $rollUser }}
                </span>
            </div>
        </a>
    </div>
</aside>
