<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Accounts;
use App\Models\AccountsAdmins;
use App\Utils\SendMail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
     public function adminLogin(Request $request)
    {

        $messageError = [
            'username' => "نام کاربری را به درستی وارد کنید",
            "password" => "پسورد را به درستی وارد کنید"
        ];
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'نام کاربری الزامی است',
            'password.required' => "رمز را خالی نگذارید"
        ]);

        $messagesResult = [];
        $errors = $validator->errors()->toArray();



        foreach ($errors as $key => $value) {
            array_push(
                $messagesResult,
                [
                    "title" => $messageError[$key],
                    "content" => $value,
                    "type" => "error"
                ]
            );
        }

        if (!count($messagesResult)) {
            $user = AccountsAdmins::where('email', $request->username)->orWhere('username', $request->username)->first();
            if ($user) {
                if (trim($request->password) == trim($user->password)) {
                    Auth::guard('admin')->login($user, true);
                    array_push(
                        $messagesResult,
                        [
                            "title" => "ورود با موفقیت انجام شد",
                            "content" => "شما در حال انتقال به پنل ادمین هستید",
                            "type" => "success"
                        ]
                    );
                } else {
                    array_push(
                        $messagesResult,
                        [
                            "title" => "ورود با شکست مواجه شد",
                            "content" => "رمز عبور شما اشتباه است",
                            "type" => "error"
                        ]
                    );
                }
            } else {
                array_push(
                    $messagesResult,
                    [
                        "title" => "این نام کاربری در سیستم وجود ندارد",
                        "content" => "این نام کاربری یا ایمیل در سیستم ما ثبت نشده است",
                        "type" => "error"
                    ]
                );
            }
        }

        $peyload_request = $request->all();
        unset($peyload_request["_token"]);



        session()->flash('messages', json_encode($messagesResult));

        if ($messagesResult[0]["type"] == "success") {
            setcookie('loginData', json_encode($peyload_request),  time() + (10 * 365 * 24 * 60 * 60), "/");
            return redirect("/admin/home");
        } else {
            return redirect()->back();
        }
    }


    public function userLogin(Request $request)
    {

        $messageError = [
            'email' => "ایمیل را به درستی وارد کنید",
            "password" => "پسورد را به درستی وارد کنید"
        ];
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'ایمیل الزامی است',
            'email.email' => 'فرمت ایمیل صحیح نیست',
            'password.required' => "رمز را خالی نگذارید"
        ]);

        $messagesResult = [];
        $errors = $validator->errors()->toArray();



        foreach ($errors as $key => $value) {
            array_push(
                $messagesResult,
                [
                    "title" => $messageError[$key],
                    "content" => $value,
                    "type" => "error"
                ]
            );
        }

        if (!count($messagesResult)) {
            $user = Accounts::where('email', $request->email)->first();
            if ($user) {
                if (trim($request->password) == trim($user->password)) {
                    Auth::guard('user')->login($user, true);
                    array_push(
                        $messagesResult,
                        [
                            "title" => "ورود با موفقیت انجام شد",
                            "content" => "شما در حال انتقال به پنل کاربران هستید",
                            "type" => "success"
                        ]
                    );
                } else {
                    array_push(
                        $messagesResult,
                        [
                            "title" => "ورود با شکست مواجه شد",
                            "content" => "رمز عبور شما اشتباه است",
                            "type" => "error"
                        ]
                    );
                }
            } else {
                array_push(
                    $messagesResult,
                    [
                        "title" => "ایمیل اشتباه است",
                        "content" => "این ایمیل در سیستم ما ثبت نشده است برای ثبت نام اقدام کنید",
                        "type" => "error"
                    ]
                );
            }
        }

        $peyload_request = $request->all();
        unset($peyload_request["_token"]);



        session()->flash('messages', json_encode($messagesResult));

        if ($messagesResult[0]["type"] == "success") {
            setcookie('loginData', json_encode($peyload_request),  time() + (10 * 365 * 24 * 60 * 60), "/");
            return redirect("/dashboard");
        } else {
            return redirect()->back();
        }
    }

    public function userRegister(Request $request)
    {

        $messageError = [
            'email' => "ایمیل را به درستی وارد کنید",
            "password" => "یک پسورد امن تر برای خود انتخاب کنید",
            "phone" => "شماره تلفن را به درستی وارد کنید",
            "surname" => "نام خانوادگی رو به درستی وارد کنید",
            "name" => "نام را به درستی وارد کنید"
        ];

        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required', 'string', 'max:255'],
                'surname' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'regex:/^09\d{9}$/'],
                'email' => ['required', 'email', 'max:255', 'unique:accounts,email'],
                'password' => [
                    'required',
                    'string',
                    'min:8',
                    'regex:/[a-z]/',
                    'regex:/[A-Z]/',
                    'regex:/[0-9]/',
                    'regex:/[@$!%*#?&]/',
                ],
            ],
            [
                'name.required' => 'وارد کردن نام الزامی است',
                'name.string' => 'نام باید به صورت متن باشد',
                'name.max' => 'نام نباید بیشتر از ۲۵۵ کاراکتر باشد',

                'surname.required' => 'وارد کردن نام خانوادگی الزامی است',
                'surname.string' => 'نام خانوادگی باید به صورت متن باشد',
                'surname.max' => 'نام خانوادگی نباید بیشتر از ۲۵۵ کاراکتر باشد',

                'phone.required' => 'شماره تلفن الزامی است',
                'phone.regex' => 'شماره تلفن باید ۱۱ رقم باشد و با 09 شروع شود',

                'email.required' => 'ایمیل الزامی است',
                'email.email' => 'فرمت ایمیل معتبر نیست',
                'email.max' => 'ایمیل نباید بیشتر از ۲۵۵ کاراکتر باشد',
                'email.unique' => 'این ایمیل قبلا ثبت شده است',

                'password.required' => 'رمز عبور الزامی است',
                'password.min' => 'رمز عبور باید حداقل ۸ کاراکتر باشد',
                'password.regex' => 'رمز عبور باید شامل حرف بزرگ، حرف کوچک، عدد و کاراکتر خاص باشد',
            ]
        );




        $messagesResult = [];
        $errors = $validator->errors()->toArray();



        foreach ($errors as $key => $value) {
            array_push(
                $messagesResult,
                [
                    "title" => $messageError[$key],
                    "content" => $value,
                    "type" => "error"
                ]
            );
        }

        $peyload_request = $request->all();
        unset($peyload_request["_token"]);

        if (!count($messagesResult)) {

            $code = Helper::generateFiveDigitCodeWithZero();
            $email = new SendMail($request->email, "کد تایید");
            $email->setMailSender("verify");
            $email->setData(json_encode($peyload_request));
            $email->setCode($code);
            $email->setInterval(180);
            $email->setHtmlContent("emails.verify_email", ["code" => $code]);
            $message = $email->send();
            if ($message["allowed"]) {
                array_push(
                    $messagesResult,
                    [
                        "title" => "کد تایید به ایمیل شما ارسال شد",
                        "content" => "شما در حال انتقال به صحفه تایید ایمیل هستید",
                        "type" => "success"
                    ]
                );
            } else {
                array_push(
                    $messagesResult,
                    [
                        "title" => "مشکل در ارسال ایمیل",
                        "content" => $message["message"],
                        "type" => "error"
                    ]
                );
            }
        }



        setcookie('registerData', json_encode($peyload_request),  time() + (10 * 365 * 24 * 60 * 60), "/");


        session()->flash('messages', json_encode($messagesResult));

        if ($messagesResult[0]["type"] == "success") {
            return redirect(route('verify.page', ["action" => "verify", "email" => $request->email]));
        } else {
            return redirect()->back();
        }
    }

    public function forgotPassword(Request $request)
    {

        $messageError = [
            'email' => "ایمیل را به درستی وارد کنید"
        ];
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ], [
            'email.required' => 'ایمیل الزامی است',
            'email.email' => 'فرمت ایمیل صحیح نیست'
        ]);

        $messagesResult = [];
        $errors = $validator->errors()->toArray();




        foreach ($errors as $key => $value) {
            array_push(
                $messagesResult,
                [
                    "title" => $messageError[$key],
                    "content" => $value,
                    "type" => "error"
                ]
            );
        }

        if (!count($messagesResult)) {
            $user = Accounts::where('email', $request->email)->first();
            if ($user) {
                if (trim($request->password)) {
                    if (trim($request->password) == trim($user->password)) {
                        Auth::guard('user')->login($user, true);
                        array_push(
                            $messagesResult,
                            [
                                "title" => "رمز شما همین است",
                                "content" => "شما در حال انتقال به پنل کاربران هستید",
                                "type" => "success"
                            ]
                        );
                        session()->flash('messages', json_encode($messagesResult));
                        return redirect("/dashboard");
                    } else {
                        $peyload_request = $request->all();
                        unset($peyload_request["_token"]);
                        $code = Helper::generateFiveDigitCodeWithZero();
                        $email = new SendMail($request->email, "کد تایید");
                        $email->setMailSender("verifyPass");
                        $email->setData(json_encode($peyload_request));
                        $email->setCode($code);
                        $email->setInterval(180);
                        $email->setHtmlContent("emails.verify_email", ["code" => $code]);
                        $message = $email->send();
                        if ($message["allowed"]) {
                            array_push(
                                $messagesResult,
                                [
                                    "title" => "کد تایید به ایمیل شما ارسال شد",
                                    "content" => "شما در حال انتقال به صحفه تایید ایمیل هستید",
                                    "type" => "success"
                                ]
                            );
                        } else {
                            array_push(
                                $messagesResult,
                                [
                                    "title" => "مشکل در ارسال ایمیل",
                                    "content" => $message["message"],
                                    "type" => "error"
                                ]
                            );
                        }

                        session()->flash('messages', json_encode($messagesResult));

                        if ($messagesResult[0]["type"] == "success") {
                            return redirect(route('verify.page', ["action" => "verifyPass", "email" => $request->email]));
                        } else {
                            return redirect()->back();
                        }
                    }
                } else {
                    $email = new SendMail($request->email, "فراموشی رمز عبور");
                    $email->setMailSender("password");
                    $email->setInterval(240);
                    $email->setHtmlContent("emails.show_password", ["password" => $user->password]);
                    $message = $email->send();
                    if ($message["allowed"]) {
                        array_push(
                            $messagesResult,
                            [
                                "title" => "رمز عبور شما برای شما ایمیل شد",
                                "content" => "برای دریافت ایمیل های خود را برسی کنید",
                                "type" => "success"
                            ]
                        );
                        session()->flash('messages', json_encode($messagesResult));
                        return redirect("/login");
                    } else {
                        $time = $message["time"];
                        array_push(
                            $messagesResult,
                            [
                                "title" => "رمز عبور برای شما ارسال شده است",
                                "content" => "برای دریافت دوباره $time ثانیه صبر کنید",
                                "type" => "error"
                            ]
                        );
                        session()->flash('messages', json_encode($messagesResult));
                        return redirect()->back();
                    }
                }
            } else {
                array_push(
                    $messagesResult,
                    [
                        "title" => "ایمیل شما در سامانه ما ثبت نشده است",
                        "content" => "لطفا برای ثبت نام اقدام کنید",
                        "type" => "error"
                    ]
                );
                session()->flash('messages', json_encode($messagesResult));
                return redirect("/register");
            }
        }
    }
}
