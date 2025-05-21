<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLoginSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!session('is_logged_in')) {
            return redirect()->route('loginPage')->with('error', 'Please log in to access this page.');
        }
        
        $userLevel = session('userLevel');

        if (empty($roles) || in_array($userLevel, $roles)) {
            return $next($request); // Access granted
        }

        return abort(403, 'Unauthorized access.');
    }
}
