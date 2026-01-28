<?php

namespace App\Jobs;

use App\Mail\SendResetEmailAccounts;
use App\Models\ForgotPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProcessSendResetEmailAccountJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $forgot = ForgotPassword::where('status', 'awaiting')->where('usable_until', '>=', now())->get();
        foreach($forgot as $f){
            Mail::to($f->email)->send(new SendResetEmailAccounts(usable_until: $f->usable_until, uuid: $f->url));
            $f->status = 'sent';
            $f->update();
        }
    }
}
