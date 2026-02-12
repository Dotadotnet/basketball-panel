<?php

namespace App\Http\Livewire;

use App\Http\Controllers\KeepPasswordsController;
use App\Models\AccountsAdmins;
use Hashids\Hashids;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class AdminLogin extends Component
{
    public $username;

    public $password;

    protected $rules = [
        'username' => 'required',
        'password' => 'required',
    ];

    protected $messages = [
        'username.required' => 'نام کاربری نمی تواند خالی باشد.',
        'password.required' => 'فیلد رمز عبور الزامی است.',
    ];

   

    public function render()
    {
        return view('livewire.admin-login');
    }
}
