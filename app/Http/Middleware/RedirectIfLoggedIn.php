<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            // Redirect based on user role
            $user = Auth::user();

            switch ($user->user_role_id) {
                case 1:
                    return redirect('/admin');
                case 2:
                    return redirect('/doctor');
                case 3:
                    return redirect('/patient');
                default:
                    return redirect('/');
            }
        }

        return $next($request);
    }
}
