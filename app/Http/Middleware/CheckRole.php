<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check()) {
            abort(403, 'Acceso denegado.');
        }

        $user = auth()->user();
        if ($user->role === 'admin') {
            return $next($request); // Admin can do everything
        }

        if ($user->role !== $role) {
            abort(403, 'Acceso denegado.');
        }

        return $next($request);
    }
}
