<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Models\CommunicationChannel;
use App\Utils\SendGate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VerifyController extends Controller
{
    public function view($action, $email)
    {
        $process = [
            "verify" => "/register",
            "verifyPass" => "/forgot-password"
        ];
        $gate = new SendGate('email', $action);
        $message = $gate->check($email);
        if (!$message["allowed"]) {
            if (isset($message["time"])) {
                return view(
                    'accounts.verify',
                    [
                        "back" => $process[$action],
                        "email" => $email,
                        "time" => $message["time"]
                    ]
                );
            } else {
                return redirect($process[$action]);
            }
        } else {
            return redirect($process[$action]);
        }
    }

    public function verify(Request $request, $email)
    {
        $gate = new SendGate('email', "verify");
        $message = $gate->check($email);

        $last = CommunicationChannel::where([
            'channel' => "email",
            'action' => "verify",
            'recipient' => $email
        ])->latest('time')->first();

        if (!$message["allowed"] && $last && $last->code == $request->code) {
            $data = json_decode($last->data, true);
            setcookie('loginData', json_encode($data),  time() + (10 * 365 * 24 * 60 * 60), "/");
            $data["callphone"] = $data["phone"];
            $user = Accounts::create($data);
            unset($data["phone"]);
            Auth::guard('user')->login($user, true);
            $last->delete();
            session()->flash('messages', json_encode([
                [
                    "title" => "ثبت نام با موفقیت انجام شد",
                    "content" => "لطفا برای پرداخت شهریه اقدام کنید",
                    "type" => "success"
                ]
            ]));
            return redirect("/dashboard");
        } else {
            session()->flash('messages', json_encode([
                [
                    "title" => "کد اشتباه بود",
                    "content" => "لطفا کد تایید را درست وارد کنید",
                    "type" => "error"
                ]
            ]));
            return redirect()->back();
        }
    }

    public function verifyPass(Request $request, $email)
    {
        $gate = new SendGate('email', "verifyPass");
        $message = $gate->check($email);

        $last = CommunicationChannel::where([
            'channel' => "email",
            'action' => "verifyPass",
            'recipient' => $email
        ])->latest('time')->first();

        if (!$message["allowed"] && $last && $last->code == $request->code) {
            $data = json_decode($last->data, true);
            setcookie('loginData', json_encode($data),  time() + (10 * 365 * 24 * 60 * 60), "/");
            Accounts::where(['email' => $data["email"]])->update(["password" => $data["password"]]);
            $user =  Accounts::where(['email' => $data["email"]])->first();
            Auth::guard('user')->login($user, true);
            $last->delete();
            session()->flash('messages', json_encode([
                [
                    "title" => "رمز عبور شما تغییر کرد",
                    "content" => "به پنل کاربران خوش آمدید",
                    "type" => "success"
                ]
            ]));
            return redirect("/dashboard");
        } else {
            session()->flash('messages', json_encode([
                [
                    "title" => "کد اشتباه بود",
                    "content" => "لطفا کد تایید را درست وارد کنید",
                    "type" => "error"
                ]
            ]));
            return redirect()->back();
        }
    }
}
