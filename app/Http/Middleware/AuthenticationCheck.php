<?php

namespace App\Http\Middleware;

use App\Http\Controllers\UserAccounts\TokenController;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class AuthenticationCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (! Session::has('AuthUser')) {
            return redirect(route('login'))->with('message', 'دسترسی غیرمجاز لطفا لاگین کنید');
        } else {
            $code = Session::get('AuthUser');
            $token = new TokenController();
            $token->using($code);
        }

        return $next($request);
    }
}
