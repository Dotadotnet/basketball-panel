<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function edite(Request $request, $id) {}


    public function home()
    {

        $gender = request()->get('gender');
        $search = request()->get('search') ? request()->get('search') : "";
        $genderRev = "none";
        if ($gender) {
            if ($gender == "women") {
                $genderRev = "men";
            } else if ($gender == "men") {
                $genderRev = "women";
            }
        }

        $list = DB::table('accounts')
            ->when($search, function ($q) use ($search) {
                $words = explode(' ', $search);
                $q->where(function ($query) use ($words) {
                    foreach ($words as $word) {
                        $query->where(function ($sub) use ($word) {
                            $sub->where('name', 'like', "%{$word}%")
                                ->orWhere('surname', 'like', "%{$word}%")
                                ->orWhere('cellphone', 'like', "%{$word}%")
                                ->orWhere('email', 'like', "%{$word}%")
                                ->orWhere('password', 'like', "%{$word}%");
                        });
                    }
                });
            })
            ->paginate(10)
            ->appends(request()->all());
        return view('admin.users', [
            'list' => $list,
            'i' => 0,
            'class' => null,
            'title' => null,
            'search' => $search
        ]);
    }


    public function destroy($id)
    {
        $t = Accounts::find($id);
        $t->delete();
        return redirect()->back();
    }

    public function create(Request $request)
    {

        $messageError = [
            'email' => "ایمیل را به درستی وارد کنید",
            "password" => "یک پسورد امن تر برای خود انتخاب کنید",
            "cellphone" => "شماره تلفن را به درستی وارد کنید",
            "surname" => "نام خانوادگی رو به درستی وارد کنید",
            "name" => "نام را به درستی وارد کنید"
        ];

        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required', 'string', 'max:255'],
                'surname' => ['required', 'string', 'max:255'],
                'cellphone' => ['required', 'regex:/^09\d{9}$/'],
                'email' => ['required', 'email', 'max:255', 'unique:accounts,email'],
                'password' => [
                    'required',
                    'string',
                    'min:8'
                ],
            ],
            [
                'name.required' => 'وارد کردن نام الزامی است',
                'name.string' => 'نام باید به صورت متن باشد',
                'name.max' => 'نام نباید بیشتر از ۲۵۵ کاراکتر باشد',

                'surname.required' => 'وارد کردن نام خانوادگی الزامی است',
                'surname.string' => 'نام خانوادگی باید به صورت متن باشد',
                'surname.max' => 'نام خانوادگی نباید بیشتر از ۲۵۵ کاراکتر باشد',

                'cellphone.required' => 'شماره تلفن الزامی است',
                'cellphone.regex' => 'شماره تلفن باید ۱۱ رقم باشد و با 09 شروع شود',

                'email.required' => 'ایمیل الزامی است',
                'email.email' => 'فرمت ایمیل معتبر نیست',
                'email.max' => 'ایمیل نباید بیشتر از ۲۵۵ کاراکتر باشد',
                'email.unique' => 'این ایمیل قبلا ثبت شده است',

                'password.required' => 'رمز عبور الزامی است',
                'password.min' => 'رمز عبور باید حداقل ۸ کاراکتر باشد',
                'password.regex' => 'رمز عبور باید شامل حرف بزرگ، حرف کوچک، عدد و کاراکتر خاص باشد',
            ]
        );




        $messages = [];
        $errors = $validator->errors()->toArray();



        foreach ($errors as $key => $value) {
            array_push(
                $messages,
                [
                    "title" => $messageError[$key],
                    "content" => $value,
                    "type" => "error"
                ]
            );
        }

        if (!count($errors)) {
            array_push(
                $messages,
                [
                    "title" => "کاربر با موفقیت افزوده شد",
                    "content" => "کاربر " . "  " . $request->all()["name"] . " " .  $request->all()["surname"] . " " . "الان در دسترس است",
                    "type" => "success"
                ]
            );
            Accounts::create($request->all());
        }
        session()->flash('messages', json_encode($messages));

        return redirect()->back();
    }


    public function edit(Request $request, $id)
    {

        $messageError = [
            'email' => "ایمیل را به درستی وارد کنید",
            "password" => "یک پسورد امن تر برای خود انتخاب کنید",
            "cellphone" => "شماره تلفن را به درستی وارد کنید",
            "surname" => "نام خانوادگی رو به درستی وارد کنید",
            "name" => "نام را به درستی وارد کنید"
        ];

        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required', 'string', 'max:255'],
                'surname' => ['required', 'string', 'max:255'],
                'cellphone' => ['required', 'regex:/^09\d{9}$/'],
                'password' => [
                    'required',
                    'string',
                    'min:8'
                ],
            ],
            [
                'name.required' => 'وارد کردن نام الزامی است',
                'name.string' => 'نام باید به صورت متن باشد',
                'name.max' => 'نام نباید بیشتر از ۲۵۵ کاراکتر باشد',

                'surname.required' => 'وارد کردن نام خانوادگی الزامی است',
                'surname.string' => 'نام خانوادگی باید به صورت متن باشد',
                'surname.max' => 'نام خانوادگی نباید بیشتر از ۲۵۵ کاراکتر باشد',

                'cellphone.required' => 'شماره تلفن الزامی است',
                'cellphone.regex' => 'شماره تلفن باید ۱۱ رقم باشد و با 09 شروع شود',

                'email.required' => 'ایمیل الزامی است',
                'email.email' => 'فرمت ایمیل معتبر نیست',
                'email.max' => 'ایمیل نباید بیشتر از ۲۵۵ کاراکتر باشد',
                'email.unique' => 'این ایمیل قبلا ثبت شده است',

                'password.required' => 'رمز عبور الزامی است',
                'password.min' => 'رمز عبور باید حداقل ۸ کاراکتر باشد',
                'password.regex' => 'رمز عبور باید شامل حرف بزرگ، حرف کوچک، عدد و کاراکتر خاص باشد',
            ]
        );




        $messages = [];
        $errors = $validator->errors()->toArray();



        foreach ($errors as $key => $value) {
            array_push(
                $messages,
                [
                    "title" => $messageError[$key],
                    "content" => $value,
                    "type" => "error"
                ]
            );
        }

        if (!count($errors)) {
            array_push(
                $messages,
                [
                    "title" => "تغییرات با موفقیت ثبت شد",
                    "content" => "تغیرات شما اعمال شد",
                    "type" => "success"
                ]
            );
            Accounts::find($id)->update($request->all());
        }
        session()->flash('messages', json_encode($messages));

        return redirect()->back();
    }






    public function createPage()
    {
        return view('admin.user_form');
    }

    public function editPage($id)
    {
        $user = Accounts::where('id', $id)->first();
        return view('admin.user_form', ['status' => "edite", "data" => $user]);
    }
}
