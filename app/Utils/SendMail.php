<?php

namespace App\Utils;

use ErrorException;
use Illuminate\Support\Facades\Http;


// نمونه کد برای استفاده
// $email = new SendMail("aminiamiraliamini1400@gmail.com","خوش آمدید");
// $email->setMailSender("verify");
// $email->setHtmlContent("emails.verify_email",["code" => "adsfsa"]);
// $email->send();


class SendMail
{

    private $apiKey;
    private $nameSender = "فدراسیون بسکتبال";
    private $mailSender = "info";
    private $domain = "bbms-tehran.ir";
    private $mailTo;
    private $data = null;
    private $code = null;
    private $subject;
    private $interval = 60; // فاصله زمانی بین ارسال‌ها (ثانیه)
    private $contect;



    public function __construct($mailTo, $subject)
    {

        # $mailTo => ایمیل مقصد
        # $subject => عنوان ایمیل
        $this->apiKey = env('MAIL_API_KEY');
        $this->mailTo = $mailTo;
        $this->subject = $subject;
    }

    public function setNameSender($nameSender)
    {
        $this->nameSender = $nameSender;
    }

    public function setMailSender($mailSender)
    {
        $this->mailSender = $mailSender;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function setCode($code)
    {
        $this->code = $code;
    }

    public function setInterval($interval)
    {
        $this->interval = $interval;
    }
    // دو راه برای ارسال کانتنت وجود داره یکی تکست ساده یکی با تمپلیت

    public function setTextContent($text)
    {
        $this->contect = $text;
    }

    public function setHtmlContent($view, $params = [])
    {
        $this->contect = view($view, $params)->render();
    }

    public function getTestContent()
    {
        echo $this->contect;
    }

    // دو راه برای ارسال کانتنت وجود داره یکی تکست ساده یکی با تمپلیت

    public function sendByBrevoTemplate($templateId, $params = [])
    {
        $response = Http::withHeaders([
            'api-key' => $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post('https://api.brevo.com/v3/smtp/email', [
            'sender' => [
                'email' => $this->mailSender . '@' . $this->domain,
                'name' => $this->nameSender
            ],
            'to' => [
                ['email' => $this->mailTo]
            ],
            'templateId' => 2,
            "link" => "https://bbms-tehran.ir/login"
        ]);
        return $response->json();
    }

    public function send()
    {
        if (!$this->contect) {
            throw new ErrorException("Use the setHtmlContent or setTextContent methods to send emails.");
        }

        $sendGate = new SendGate("email", $this->mailSender, $this->interval, $this->code, $this->data);
        $check = $sendGate->check($this->mailTo);

        if ($check['allowed']) {
            $sendGate->create($this->mailTo);
            Http::withHeaders([
                'api-key' => $this->apiKey,
                'Content-Type' => 'application/json',
            ])->post('https://api.brevo.com/v3/smtp/email', [
                'sender' => [
                    'email' => $this->mailSender . '@' . $this->domain,
                    'name' => $this->nameSender
                ],
                'to' => [
                    ['email' => $this->mailTo]
                ],
                'subject' => $this->subject,
                'htmlContent' => $this->contect,
            ]);
        }


        return $check;
    }
}
