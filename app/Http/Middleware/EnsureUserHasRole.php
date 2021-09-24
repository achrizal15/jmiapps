<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {

        $user = auth()->user()->role_id;
        for ($i = 1; $i < 5; $i++) {
            if ($user == $role) {
                return $next($request);
            }
        }
        if ($user== 1) {
            return redirect('/pemilik');
        } elseif ($user== 2) {
            return redirect('/admin');
        } elseif ($user== 3) {
            return redirect('/teknisi');
        } else {
            return redirect('/pelanggan');
        }
    }
}
