<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MegaAuthenticationController;
use App\Models\TeamsPaymentsUsabilities;
use App\Models\TeamsReceiptPayments;
use Hashids\Hashids;

class AccountsAdminsController extends Controller
{
    // accounts_admins create, accounts_admins view, accounts_admins setting, confirmation,

    public function login()
    {
        return view('admin.login');
    }

    public function logout()
    {
        $mega = new MegaAuthenticationController();
        $mega->destroy('admin');

        return redirect()->route('admin.login');
    }

    public function payment()
    {
        $payments = TeamsReceiptPayments::with('usabilities')
            ->with('accounts')
            ->orderByDesc('id')
            ->paginate(11);
//        $payments = TeamsPaymentsUsabilities::with('payment')->get();
//        dd($payments);
        return view('admin.payment', [
            'payments' => $payments,
            'i' => 0,
        ]);
    }

    public function paymentDelete($id)
    {
        $hash = new Hashids();
        $payment = TeamsReceiptPayments::find($hash->decode($id)[0]);
        $payment->delete();

        return redirect()->back();
    }

    public function paymentConfirm($id)
    {
        $hash = new Hashids();
        $payment = TeamsReceiptPayments::find($hash->decode($id)[0]);
        $payment->status = 'correct';
        $payment->update();
        $usabilities = new TeamsPaymentsUsabilities();
        $usabilities->time_limitation = 8; // 7 days
        $usabilities->usable_until = now()->seconds(3600 * 24 * 7); // 7 days
        $usabilities->status = 'enable';
        $usabilities->teams_payments_id = $payment->id;
        $usabilities->accounts_id = $payment->accounts_id;
        $usabilities->save();

        return redirect()->back();
    }
}
