<?php

namespace App\Http\Middleware;

use App\Http\Controllers\MegaAuthenticationController;
use App\Models\AccountsAdmins;
use Closure;
use Illuminate\Http\Request;

class AdminManager
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
        $id = $megaAuth->get_account_id('admin');
        $accounts = AccountsAdmins::where('id', '=', $id)->where('manager','=',true)->first();

        if(empty($accounts)){
            return abort(403, 'دسترسی فقط برای مدیرکل مجاز است');
        }
        return $next($request);
    }
}
