<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Si no está logueado, mandarlo al login
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        // 2. Usamos la función hasAnyRole del modelo User
        // Verifica si el usuario tiene alguno de los roles permitidos
        if ($user->hasAnyRole($roles)) {
            return $next($request);
        }

        // 3. Si no tiene permiso, error 403 (Prohibido)
        abort(403, 'ACCESO DENEGADO: No tienes permisos para ver esta sección.');
    }
}