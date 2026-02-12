<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Mail\VerifyEmail;
use App\Models\Accounts;
use App\Models\AccountsAdmins;
use App\Models\KeepPasswords;
use App\Models\ListOfTeamNames;
use App\Utils\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    public function mail()
    {
        // set_time_limit(300); // 5 دقیقه
        // $nonEmailUsers = KeepPasswords::withoutGlobalScopes()->get();
        // foreach ($nonEmailUsers as $nonEmailUser) {
        //     Accounts::where('email', $nonEmailUser->username)->update(['password' => $nonEmailUser->password]);
        // }

      
        // $email->send();
    }
}
