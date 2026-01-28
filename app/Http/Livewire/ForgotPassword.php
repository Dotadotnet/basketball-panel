<?php

namespace App\Http\Livewire;

use App\Jobs\ProcessSendResetEmailAccountJob;
use App\Models\ForgotPassword as ForgotPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Livewire\Component;

class ForgotPassword extends Component
{
    public $email;
    protected $rules = [
        'email' => 'required'
    ];

    protected $messages = [
        'email.required' => 'آدرس ایمیل نمی تواند خالی باشد.',
    ];
    public function render()
    {
        return view('livewire.forgot-password');
    }

    public function submit()
    {
        check:
        $url = Str::uuid();
        $c = ForgotPasswords::where('url', $url)->first();
        if(!is_null($c)){
            goto check;
        }

        $valid = $this->validate();
        $forgot = new ForgotPasswords();
        $forgot->request_by = \request()->ip();
        $forgot->url = $url;
        $forgot->email = $valid['email'];
        $forgot->usable_until = now()->addMinutes(60);
        $forgot->save();
        $job = (new ProcessSendResetEmailAccountJob())->delay(now()->addMinutes(1));
        dispatch($job);
        Session::flash('message', 'درخواست شما ثبت گردید، درصورت صحت آدرس ایمیل تا دقایقی دیگر یک پیام برای شما ارسال می‌گردد');
        return $this->redirect(route('login'));
    }
}
