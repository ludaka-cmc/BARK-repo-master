<?php

namespace AKCBark\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthBackpack
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param string|null              $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::check() && (Auth::user()->admin || app()->environment() == 'local' || app()->environment() == 'stage')) {
            return $next($request);
        }

        return redirect('/');
    }
}
