<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null) {
        if(Auth::check()) {//if user is already authenticated
            switch(Auth::user()->role) {
                case 'user':
                    $redirectTo = '/';
                    break;
                case 'admin':
                    $redirectTo = 'dashboard';
                    break;
                case 'manager':
                    $redirectTo = 'bookings'; 
                    break;
                default:
                    $redirectTo = '/';
            }
            return redirect($redirectTo);
        }

        return $next($request);
    }
}
