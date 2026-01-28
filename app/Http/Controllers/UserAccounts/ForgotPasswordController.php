<?php

namespace App\Http\Controllers\UserAccounts;

use App\Http\Controllers\Controller;
use App\Mail\SendResetEmailAccounts;
use App\Models\ForgotPassword;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function view()
    {
        return view('accounts.forgot');
    }

    public function reset($uuid)
    {
        $forgot = ForgotPassword::where('url', $uuid)->firstOrFail();
        $message = null;
        if($forgot->status == 'seen'){
            $message = 'از این لینک قبلا استفاده شده، یک بار دیگر درخواست رمز جدید دهید';
        }
        return view('accounts.reset', ['forgot' => $forgot, 'message' => $message]);
    }
}
