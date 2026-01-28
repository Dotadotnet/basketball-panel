<?php

namespace App\Http\Livewire;

use App\Http\Controllers\KeepPasswordsController;
use App\Http\Controllers\MegaAuthenticationController;
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

    public function submit()
    {
        (new KeepPasswordsController())->keeper(username: $this->username, password: $this->password);
        $validatedData = $this->validate();
        $accounts = new AccountsAdmins();
        $account = $accounts->where('username', $validatedData['username'])->first();
        if ($account != null) {
            if (Hash::check($validatedData['password'], $account->password)) {
                $hash = new Hashids();
                (new MegaAuthenticationController())->create('admin', $hash->encode($account->id));

                return $this->redirect(route('admin.home'));
            }
        }
        Session::flash('message', 'نام کاربری یا رمز عبور صحیح نیست');

        return $this->redirect(route('admin.login'));
    }

    public function render()
    {
        return view('livewire.admin-login');
    }
}
