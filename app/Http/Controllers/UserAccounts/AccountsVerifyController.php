<?php

namespace App\Http\Controllers\UserAccounts;

use App\Http\Controllers\Controller;
use App\Models\AccountsVerifyEmails;
use Illuminate\Support\Str;

class AccountsVerifyController extends Controller
{
    public function mail(int $accounts_id)
    {
        

        return "jui";
    }

    public function check($url)
    {
        $verify = new AccountsVerifyEmails();
        $result = $verify->where('uuid', $url)->first();
        if ($result->status == 'old') {
            return view('emails.verify_email_old');
        }
        

        if ($result->status == 'used') {
            return view('emails.verify_email_used');
        }

        if (now() > $result->usable_until) {
            return view('emails.verify_email_time_over');
        }

        if ($result) {
            $result->status = 'used';
            $result->save();

            return redirect(route('login'));
        }

        return abort(404);
    }
}
