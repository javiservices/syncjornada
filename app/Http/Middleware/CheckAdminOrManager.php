<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminOrManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            abort(403, 'Acceso denegado.');
        }

        $user = auth()->user();
        if (!in_array($user->role, ['admin', 'manager'])) {
            abort(403, 'Acceso denegado.');
        }

        return $next($request);
    }
}
