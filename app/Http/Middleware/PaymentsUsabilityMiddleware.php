<?php

namespace App\Http\Middleware;

use App\Http\Controllers\MegaAuthenticationController;
use App\Models\TeamsPaymentsUsabilities;
use Closure;
use Illuminate\Http\Request;

class PaymentsUsabilityMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $megaAuth = new MegaAuthenticationController();
        $payments = TeamsPaymentsUsabilities::where('accounts_id', $megaAuth->get_account_id('user'))->get();
        if (! $payments->isEmpty()) {
            foreach ($payments as $p) {
                if ($p->status == 'enable' && $p->usable_until > now()) {
                    //credit is True
                    return $next($request);
                }
            }
        }
        //redirect to payment
        $request->session()
            ->flash('error', 'باید ثبت فیش واریزی انجام دهید، توجه داشته باشید که فقط پس از تایید فیش واریزی امکان  دسترسی به بخش ورود اطلاعات خواهید داشت<br>
                                <strong>توجه: اگر ثبت فیش انجام داده‌اید لطفا تا تایید آن صبر نمایید</strong>');

        return redirect()->route('dashboard.payment');
    }
}
