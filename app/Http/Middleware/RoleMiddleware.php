<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $roles
     * @return \Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        // Allow for multiple roles separated by commas
        $rolesArray = explode(',', $roles);

        // Check if the user is authenticated and has a valid role
        if (Auth::check() && in_array(Auth::user()->role, $rolesArray)) {
            return $next($request);  // Proceed with the request if the role matches
        }

        // Redirect to home if the user doesn't have the correct role
        return redirect()->route('home')->with('error', 'You do not have permission to access this page.');
    }
}