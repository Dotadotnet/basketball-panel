<?php

namespace App\Http\Controllers;

use App\Mail\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;



class TestController extends Controller
{
    public function mail()
    {
        Mail::to('aminiamiraliamini1400@gmail.com')->send(new VerifyEmail("sdfa"));

        return "dafa";
    }
}
