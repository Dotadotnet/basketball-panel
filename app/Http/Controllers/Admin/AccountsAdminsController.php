<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamsPaymentsUsabilities;
use App\Models\TeamsReceiptPayments;
use Hashids\Hashids;
use Illuminate\Support\Facades\Auth;

class AccountsAdminsController extends Controller
{
    // accounts_admins create, accounts_admins view, accounts_admins setting, confirmation,

    public function login()
    {
        return view('accounts.login_admin');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }

    public function payment()
    {
        $status = request()->get('status');
        $search = request()->get('search') ? request()->get('search') : "";
        $allowedStatuses = ['correct', 'defective', 'awaitingReview']; // لیست وضعیت‌های دیتابیس
        $payments = TeamsReceiptPayments::with('usabilities')
            ->with('accounts')
            ->when($search, function ($q) use ($search) {
                $words = explode(' ', $search);
                $q->whereHas('accounts', function ($query) use ($words) {
                    foreach ($words as $word) {
                        if ($word === '') continue;
                        $query->where(function ($sub) use ($word) {
                            $sub->where('name', 'like', "%{$word}%")
                                ->orWhere('surname', 'like', "%{$word}%");
                        });
                    }
                });
            })
            ->when($status && in_array($status, $allowedStatuses), function ($q) use ($status) {
                $q->where('status', $status);
            })->orderByDesc('id')
            ->paginate(10)
            ->appends(request()->all());


        return view('admin.payment', [
            'payments' => $payments,
            'i' => 0,
            "status" => $status,
            "search" => $search
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
