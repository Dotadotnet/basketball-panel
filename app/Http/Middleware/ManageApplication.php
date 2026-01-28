<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ManageApplication
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Application|Factory|View
     */
    public function handle(Request $request, Closure $next)
    {
        $manage = \App\Models\ManageApplication::first();
        if($manage!=null && $manage->status_flag == 'disable'){
//            $message = $manage->status_message;
            return response(view('admin.subscription_server'));
        }
        return $next($request);
    }
}
