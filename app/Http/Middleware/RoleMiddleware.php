<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        $roles = [
            'admin' => 1,
            'provider' => 2,
            'client' => 3
        ];

        if (!is_numeric($role) && $user->user_role_id != ($roles[$role] ?? null)) {
            abort(403, 'Unauthorized');
        }

        if (is_numeric($role) && $user->user_role_id != $role) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
