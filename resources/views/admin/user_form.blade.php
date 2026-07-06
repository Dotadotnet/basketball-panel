@extends('layout.admin_template')
@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4 class="mb-0 p-2">افزودن کاربر</h4>
            </div>

            <div class="card-body">
                <form method="POST"
                    action="{{ isset($status) ? route('admin.user.form.edit', $data->id) : route('admin.user.form.create') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label dir="rtl" class="direction-rtl my-2 pe-4 w-100" for="email">نام
                                    :</label>
                                <input dir="rtl" name="name" placeholder="علی" type="text"
                                    class="p-2 form-control">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label dir="rtl" class="direction-rtl my-2 pe-4 w-100" for="email">نام خانوادگی
                                    :</label>
                                <input dir="rtl" name="surname" placeholder="امینی" type="text"
                                    class="p-2 form-control">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label dir="rtl" class="direction-rtl my-2 pe-4 w-100" for="email">آدرس ایمیل
                                    :</label>
                                <input dir="rtl" name="email" placeholder="example@gmail.com" type="text"
                                    class="p-2 form-control">
                            </div>

                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label dir="rtl" class="direction-rtl my-2 pe-4 w-100" for="email">شماره تلفن
                                    :</label>
                                <input dir="rtl" name="cellphone" placeholder=".... 0912" type="text"
                                    class="p-2 form-control">
                            </div>
                        </div>


                        <div class="col-md-6 mb-3">
                            @component('components.passwordInput', ['show' => true, 'text' => 'یک رمز برای خود بنویسید'])
                            @endcomponent
                        </div>

                        <div class="col-md-6 mb-3">
                            <div
                                style="display: flex; justify-content: center ; align-items: center ; height: 100%; padding-top: 10px ">
                                <button type="submit" class="btn  btn-primary">
                                    ذخیره اطلاعات
                                </button>
                            </div>
                        </div>



                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @if (isset($data))
        <script>
            const data = @json($data);
            const status = @json($status);
            Object.entries(data).forEach(([key, value]) => {
                const element = document.querySelector(`[name="${key}"]`);
                if (element) {
                    element.value = value ?? '';
                }
            });
        </script>
    @else
        <script>
            const inputs = document.querySelectorAll("input");
            setTimeout(() => {
                inputs.forEach(input => {
                    if (input.name !== "_token")
                        input.value = "";
                });
            }, 1000)
        </script>
    @endif
@endsection
