<div class="form-group mt-2">
    <label dir="rtl" class="direction-rtl mb-2 pe-4 w-100" for="password">رمز عبور
        :</label>
    <div data-status="hide" class="position-relative password-input">
        <div style="left: 10px" class="position-absolute top-0 h-100  justify-content-center d-flex align-items-center ">
            <button type="button" style="width: 28px;height: 28px;outline: none; box-shadow: none;"
                class="btn btn-primary  d-flex justify-content-center p-0 align-items-center ">
                <svg class="show d-none" style="width: 22px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M12 9a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3m0 8a5 5 0 0 1-5-5a5 5 0 0 1 5-5a5 5 0 0 1 5 5a5 5 0 0 1-5 5m0-12.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5" />
                </svg>
                <svg class="hide " style="width: 22px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M11.83 9L15 12.16V12a3 3 0 0 0-3-3zm-4.3.8l1.55 1.55c-.05.21-.08.42-.08.65a3 3 0 0 0 3 3c.22 0 .44-.03.65-.08l1.55 1.55c-.67.33-1.41.53-2.2.53a5 5 0 0 1-5-5c0-.79.2-1.53.53-2.2M2 4.27l2.28 2.28l.45.45C3.08 8.3 1.78 10 1 12c1.73 4.39 6 7.5 11 7.5c1.55 0 3.03-.3 4.38-.84l.43.42L19.73 22L21 20.73L3.27 3M12 7a5 5 0 0 1 5 5c0 .64-.13 1.26-.36 1.82l2.93 2.93c1.5-1.25 2.7-2.89 3.43-4.75c-1.73-4.39-6-7.5-11-7.5c-1.4 0-2.74.25-4 .7l2.17 2.15C10.74 7.13 11.35 7 12 7" />
                </svg>
            </button>
        </div>
        <input dir="rtl" name="password" placeholder="{{ isset($text) ? $text : 'رمز عبور خود را وارد کنید' }}"
            type="password" class="form-control p-2 " style="padding-left: 45px !important;" id="password"
            aria-describedby="password">
    </div>
</div>


<script>
    let password_input_div = document.querySelector("div.password-input");
    let password_input = password_input_div.querySelector("input");
    let password_button = password_input_div.querySelector("button");
    let icon_show = password_button.querySelector("svg.show")
    let icon_hide = password_button.querySelector("svg.hide")
    const show = {{ isset($show) ? $show ? 'true' : 'false' : 'false' }};


    const toggleShowHideInput = () => {
        if (password_input.type == "password") {
            password_input.type = "text";
            icon_show.classList.toggle("d-none")
            icon_hide.classList.toggle("d-none")
        } else {
            password_input.type = "password";
            icon_show.classList.toggle("d-none")
            icon_hide.classList.toggle("d-none")
        }
    }


    password_button.addEventListener("click", () => {
        toggleShowHideInput()
    })


    if (show) {
        toggleShowHideInput();
    }
</script>
