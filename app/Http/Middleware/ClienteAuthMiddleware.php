<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ClienteAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('cliente')->check()) {
            return $next($request);
        }

        return redirect('/login')->with('message', 'Debes iniciar sesión como cliente para acceder a esta función.');
    }
}
