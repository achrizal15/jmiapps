<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;
    
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = auth()->user()->role_id;
                if ($user == 1) {
                    return redirect('/pemilik');
                } elseif ($user == 2) {
                    return redirect('/admin');
                } elseif ($user == 3) {
                    return redirect('/teknisi');
                } else {
                    return redirect('/pelanggan');
                }
            }
        }

        return $next($request);
    }
}
