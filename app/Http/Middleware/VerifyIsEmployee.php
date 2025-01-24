<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyIsEmployee
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the authenticated user exists and has an email ending with @smilepro.com
        if (Auth::check() && str_ends_with(Auth::user()->email, '@smilepro.com')) {
            return $next($request);
        }

        // Redirect unauthorized users
        return redirect('/')->with('error', 'Unauthorized access.');
    }
}
