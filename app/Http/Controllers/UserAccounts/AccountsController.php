<?php

namespace App\Http\Controllers\UserAccounts;

use App\Http\Controllers\Controller;
use App\Mail\verify_email;
use App\Models\AccountsVerifyEmails;
use Hekmatinasser\Verta\Verta;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;

class AccountsController extends Controller
{
    
    public function register(): Factory|View|Application
    {
        return view('accounts.register');
    }
    

    public function login(): Factory|View|Application
    {
        return view('accounts.login');
    }

    public function registerProcess($email, $accountVerifyMailId)
    {
      echo "dasf";
    }
}
