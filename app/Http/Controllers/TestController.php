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
        set_time_limit(0);
        ini_set('max_execution_time', 0);
        $users = Accounts::all();
        foreach ($users as $user) {
            $code = "A" . Helper::generateFiveDigitCodeWithZero();
            $password = trim($user->password);
            if (str_contains($password, '$2y$10$') && strlen($password) > 30) {
                Accounts::where('id', $user->id)->update(["password" => $code]);
            }
        }
    }
}
