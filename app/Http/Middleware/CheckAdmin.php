<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
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
        if ($user->role !== 'admin') {
            abort(403, 'Solo los administradores pueden realizar esta acción.');
        }

        return $next($request);
    }
}
