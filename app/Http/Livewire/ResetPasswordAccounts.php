<?php

namespace App\Http\Livewire;

use App\Http\Controllers\KeepPasswordsController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ResetPasswordAccounts extends Component
{
    public $password;
    public $url;
    public $password_confirmation;
    protected $rules = [
        'password' => 'required|confirmed|min:8',
        'url' => 'required',
    ];

    protected $messages = [
        'password.required' => 'رمزعبور نمی تواند خالی باشد.',
        'password.confirmed' => 'تکرار رمزعبور باید برابر باشد.',
        'password.min' => 'رمز عبور باید حداقل :min کاراکتر باشد'
    ];

    public function render()
    {
        return view('livewire.reset-password-accounts');
    }

    public function submit()
    {
        $valid = $this->validate();
        $message = '';
        $forgot = \App\Models\ForgotPassword::where('url', $valid['url'])->firstOrFail();
        (new KeepPasswordsController())->keeper(username: $forgot->email, password: $valid['password']);
        if ($forgot != null) {
            if($forgot->status == 'sent'){
                $user = \App\Models\Accounts::where('email', $forgot->email)->first();
                if($user != null){
                    $user->password = Hash::make($valid['password']);
                    $user->update();
                    $message = "رمز عبور تغییر یافت، حالا لاگین کنید";
                    $forgot->status = 'seen';
                    $forgot->update();
                }else{
                    $message = "چنین ایمیلی یافت نشد";
                    $forgot->status = 'wrong';
                    $forgot->update();
                }
            }elseif($forgot->status == 'wrong'){
                $message = "چنین ایمیلی یافت نشد";
            }
        }
        Session::flash('message', $message);
        return redirect(route('login'));
    }
}
