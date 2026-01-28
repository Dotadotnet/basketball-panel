<?php

namespace App\Http\Controllers\ManageApplications;

use App\Http\Controllers\Controller;
use App\Models\ManageApplicationsPayments;
use Carbon\Carbon;
use Shetabit\Multipay\Invoice;
use Shetabit\Multipay\Payment;

class PaymentsController extends Controller
{
    public function create_genesis()
    {
        $check = ManageApplicationsPayments::where('genesis', '=', true)->get();
        if ($check->isEmpty()) {
            $payment = new ManageApplicationsPayments();
            $payment->payment_deadline = now();
            $payment->show_payment = now();
            $payment->payment_status = 'paid';
            $payment->genesis = true;
            $payment->save();
        }
    }
    // first init payment
    // show_status normal
    // check after 20 days
    // show_status can pay
    // check after 25 days
    // show_status popup pay
    // check after 30 days
    // show_status disable use application
    public function check_days_payment($days)
    {
        return ManageApplicationsPayments::where('payment_status', '=', 'paid')
            ->where('checking_status', '=', 'waiting')
            ->where('created_at', '<=', Carbon::now()->subDays($days))
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function checker()
    {
        $day_30 = $this->check_days_payment(30);
        $day_25 = $this->check_days_payment(25);
        $day_20 = $this->check_days_payment(20);
        if ($day_30->isNotEmpty()) {
            // show_status disable use application
            dd($day_30, 30);
        } elseif ($day_25->isNotEmpty()) {
            // show_status popup pay
            dd($day_25, 25);
        } elseif ($day_20->isNotEmpty()) {
            // show_status can pay
            dd($day_20, 20);
        } else {
            $this->create_genesis();
        }
    }

    public function prepayment()
    {
        $payment = new ManageApplicationsPayments();
        $payment->bills_id = 0; # todo how find bill
        $payment->payment_deadline = now()->addDays(10);
        $payment->show_payment = now();
        $payment->payment_status = 'awaiting-payment';
        $payment->save();
    }

    # show price payment

    public function total_amount()
    {

        $t = ManageApplicationsPayments::where('payment_status', '=', 'awaiting-payment')
            ->where('checking_status', '=', 'waiting')
            ->where('bills_id', '!=', null)
            ->with(['bills' => function ($query) {
                $query->where('status', '=', true)
                    ->orderBy('priority', 'asc');
            }])
            ->get();
        foreach ($t as $item) {
            return $item->bills->id;
        }
    }

    # show page

    public function bank_gateway()
    {
        // load the config file from your project
        $paymentConfig = require(base_path('config/payment.php'));

        $payment = new Payment($paymentConfig);


        // Create new invoice.
        $invoice = (new Invoice)->amount(10000);

        // Purchase the given invoice.
        $payment->purchase($invoice,function($driver, $transactionId) {
            // We can store $transactionId in database.
        });

        // Purchase method accepts a callback function.
        $payment->purchase($invoice, function($driver, $transactionId) {
            // We can store $transactionId in database.
        });

        // You can specify callbackUrl
        $payment->callbackUrl(url: route('fee.verify'))->purchase(
            $invoice,
            function($driver, $transactionId) {
                // We can store $transactionId in database.
            }
        );
//        $t = $zarin->request(callbackURL: 'http://bbms.ir',Amount: $this->total_amount(),Description: 'پرداخت ماهانه سرور',Email: '',Mobile: '');
    }
}
