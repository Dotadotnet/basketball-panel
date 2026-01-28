<?php

namespace App\Http\Middleware;

use App\Http\Controllers\MegaAuthenticationController;
use Closure;
use Illuminate\Http\Request;

class MegaAuthenticationMiddleware
{
    /** @var string route name */
    private string $redirect_user = 'login';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ((new MegaAuthenticationController())->check('admin')) {
            return $next($request);
        }

        return redirect(route($this->redirect_user));
    }
}
