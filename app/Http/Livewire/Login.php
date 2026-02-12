<?php

namespace App\Http\Livewire;

use App\Http\Controllers\KeepPasswordsController;
use Hashids\Hashids;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Login extends Component
{
    public $email;

    public $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    protected $messages = [
        'email.required' => 'آدرس ایمیل نمی تواند خالی باشد.',
        'email.email' => 'فرمت آدرس ایمیل معتبر نیست.',
        'password.required' => 'فیلد رمز عبور الزامی است.',
    ];

  

    public function render()
    {
        return view('livewire.login');
    }
}
