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
// In the Role middleware (e.g., app/Http/Middleware/RoleMiddleware.php)
public function handle($request, Closure $next, $role)
{
    $roles = explode('|', $role);
    if (!in_array(auth()->user()->role, $roles)) {
        return redirect('/home'); // or a specific error page
    }

    return $next($request);
}

}