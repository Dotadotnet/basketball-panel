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
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    public function mail()
    {
        set_time_limit(0);
        ini_set('max_execution_time', 0);
        $res = Http::withHeaders([
            'api-key' => env('MAIL_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://api.brevo.com/v3/smtp/email', [
            'sender' => [
                'email' => "info" . '@' . "bbms-tehran.ir",
                'name' => "فدراسیون"
            ],
            'to' => [
                ['email' => "aminiamiraliamini1400@gmail.com"]
            ],
            'subject' => "ADsfad",
            'htmlContent' => "ADFasfafdsda",
        ]);
        return response($res);
    }
}
