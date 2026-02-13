@php
    $user = Auth::guard('admin')->user();
    $imageUser = asset('images/user_def.jpg');
    $nameUser = $user->name . ' ' . $user->surname;
    $rollUser = 'ادمین';
    
    $rollUser = $user->manager ? "مدیر کل" : "ادمین";    
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
                    <span style="font-size: 9px" class="logo-subtitle mr-5 font-parastoo font-bold">پنل ادمین</span>
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
                    <a href="/admin/home"><span class="icon home" aria-hidden="true"></span>داشبورد</a>
                </li>
                 <li>
                    <a href="/admin/review/confirmation"><svg  style="width: 24px;height: 24px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M12 13c2.396 0 4.575.694 6.178 1.671c.8.49 1.484 1.065 1.978 1.69c.486.616.844 1.352.844 2.139c0 .845-.411 1.511-1.003 1.986c-.56.45-1.299.748-2.084.956c-1.578.417-3.684.558-5.913.558s-4.335-.14-5.913-.558c-.785-.208-1.524-.506-2.084-.956C3.41 20.01 3 19.345 3 18.5c0-.787.358-1.523.844-2.139c.494-.625 1.177-1.2 1.978-1.69C7.425 13.694 9.605 13 12 13" class="duoicon-primary-layer"/><path fill="currentColor" d="M12 2c3.849 0 6.255 4.167 4.33 7.5A5 5 0 0 1 12 12c-3.849 0-6.255-4.167-4.33-7.5A5 5 0 0 1 12 2" class="duoicon-secondary-layer" opacity="0.3"/></svg>
                        برسی ورود اطلاعات
                    </a>
                </li>
                <li>
                    <a href="/admin/payment"><span class="icon document" aria-hidden="true"></span>پرداختی ها</a>
                </li>
               
                
                <li>
                    <a href="/admin/setting/game-season/list"><span class="icon setting" aria-hidden="true"></span>
                    تنظیمات فصل مسابقاتی
                    </a>
                </li>
                 <li>
                    <a href="/admin/admin-users">
                        <svg style="width: 24px;height: 24px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M12 14v2a6 6 0 0 0-6 6H4a8 8 0 0 1 8-8m0-1c-3.315 0-6-2.685-6-6s2.685-6 6-6s6 2.685 6 6s-2.685 6-6 6m0-2c2.21 0 4-1.79 4-4s-1.79-4-4-4s-4 1.79-4 4s1.79 4 4 4m9 6h1v5h-8v-5h1v-1a3 3 0 1 1 6 0zm-2 0v-1a1 1 0 1 0-2 0v1z"/></svg>
                    کاربران ادمین
                    </a>
                </li>
             
            </ul>

            <ul class="sidebar-body-menu d-none">
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
                @if (Auth::guard('admin')->user()->is_super_admin)
                    <li>
                        <a class="show-cat-btn" href="##">
                            <span class="icon admin-icon" aria-hidden="true"></span>ادمین ها
                            <span class="category__btn transparent-btn" title="Open list">
                                <span class="sr-only">Open list</span>
                                <span class="icon arrow-down" aria-hidden="true"></span>
                            </span>
                        </a>
                        <ul class="cat-sub-menu">
                            <li>
                                <a href="/panel/admin/create">اضافه کردن</a>
                            </li>
                            <li>
                                <a href="/panel/admin">حذف و تغییر</a>
                            </li>
                        </ul>
                    </li>
                @endif
                <li>
                    <a href="##"><span class="icon setting" aria-hidden="true"></span>Settings</a>
                </li>
            </ul>
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
