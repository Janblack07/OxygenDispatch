<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();

        if (!$user) {
            abort(401);
        }

        // roles recibidos: PROGRAMADOR, ADMINISTRADOR
        $allowed = array_map(fn ($r) => strtoupper(trim((string) $r)), $roles);
        $current = strtoupper(trim((string) $user->role));

        if (!in_array($current, $allowed, true)) {
            abort(403, 'No tienes permisos para acceder a esta sección.');
        }

        return $next($request);
    }
}
