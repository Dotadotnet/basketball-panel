<?php

namespace App\Utils;

use App\Models\CommunicationChannel;
use Carbon\Carbon;
use Illuminate\Support\Str;

class SendGate
{
    protected int $ipLimit = 5;        // تعداد درخواست مجاز از هر IP
    protected int $ipWindowMinutes = 60; // بازه زمانی برای محدودیت IP (دقیقه)
    protected string $channel = "email"; // نوع کانال (email, sms, push)
    protected string $action;
    protected int $interval; // فاصله زمانی بین ارسال‌ها (ثانیه)
    protected string $ip;
    private $data = null;
    private $code = null;

    public function __construct(string $channel, string $action, $interval = 120, $code = null, $data = null)
    {
        $this->channel = $channel;
        $this->action = $action;
        $this->ip = request()->ip();
        $this->interval = $interval;
        $this->data = $data;
        $this->code = $code;
    }

    public function create(string $email)
    {
        CommunicationChannel::create([
            'channel' => $this->channel,
            'action' => $this->action,
            'recipient' => $email,
            'ip' => $this->ip,
            "data" =>  $this->data,
            "interval" => $this->interval,
            "code" => $this->code
        ]);
    }
    public function clear()
    {
        $now = Carbon::now()->timestamp;
        $threshold = now()->timestamp - 86400;
        CommunicationChannel::where('time', '<', $now)->delete();
    }
    public function check(string $email)
    {
        $now = Carbon::now()->timestamp; // ثانیه از Epoch

        // --- محدودیت IP: تعداد درخواست در بازه زمانی ---
        $recentFromIp = CommunicationChannel::where('ip', $this->ip)->where('time', '>=', $now - ($this->ipWindowMinutes * 60))->count();

        if ($recentFromIp > $this->ipLimit) {
            return [
                'allowed' => false,
                'message' => "تعداد درخواست‌ها از این IP بیش از حد مجاز است."
            ];
        }

        // --- فاصله زمانی ایمیل (interval) ---
        $record = CommunicationChannel::where([
            'channel' => $this->channel,
            'action' => $this->action,
            'recipient' => $email
        ])->latest('time')->first();

        if (!$record) {
            return [
                'allowed' => true,
                'message' => 'ارسال شد'
            ];
        }


        $intervalRcord = $now - $record->time;
        $remaining =  $record->interval - $intervalRcord;




        if ($intervalRcord < $record->interval) {
            return [
                'allowed' => false,
                "time" => $remaining,
                'message' => "لطفاً $remaining ثانیه دیگر صبر کنید تا ایمیل دوباره ارسال شود."
            ];
        } else {
            return [
                'allowed' => true,
                "time" => $remaining,
                'message' => 'ارسال شد'
            ];
        }

        return [
            'allowed' => true,
            "time" => $remaining,
            'message' => 'ارسال شد'
        ];
    }
}
