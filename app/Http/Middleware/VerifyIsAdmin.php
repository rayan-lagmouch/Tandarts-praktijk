<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VerifyIsAdmin
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
        // Use the logic from isAdmin method directly here
        if (Auth::check() && str_ends_with(Auth::user()->email, '@admin.com')) {
            return $next($request);
        }

        // Log the unauthorized access attempt with more details
        if (Auth::check()) {
            Log::warning('Unauthorized access attempt by user: ' . Auth::user()->email .
                ' | IP: ' . $request->ip() .
                ' | URL: ' . $request->fullUrl());
        }

        // Redirect unauthorized users with an error message
        return redirect('/')->with('error', 'You must be an admin to access this page.');
    }
}
