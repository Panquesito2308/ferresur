<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $maxAttempts = 3;
        $lockoutTime = 60; // 1 minuto en segundos

        // Verificar si el bloqueo ya expiró
        if (session('locked_until') && now()->timestamp > session('locked_until')) {
            session()->forget(['locked_until', 'account_locked', 'login_attempts']); // Limpiar todo
        }

        // Si está bloqueado actualmente
        if (session('account_locked')) {
            return back()
                ->with('account_locked', true)
                ->withErrors(['username' => 'Cuenta bloqueada. Intente nuevamente en 1 minuto.']);
        }

        // Intento de autenticación
        if (Auth::attempt($request->only('username', 'password'))) {
            session()->forget(['login_attempts', 'locked_until', 'account_locked']); // Limpiar al loguearse
            $user = Auth::user();
            // Redirección por rol (igual que antes)
        }

        // Incrementar intentos fallidos
        $attempts = session('login_attempts', 0) + 1;
        session(['login_attempts' => $attempts]);

        // Bloquear después de 3 intentos
        if ($attempts >= $maxAttempts) {
            session([
                'locked_until' => now()->timestamp + $lockoutTime,
                'account_locked' => true,
            ]);
            return back()
                ->with('account_locked', true)
                ->withErrors(['username' => 'Cuenta bloqueada. Intente nuevamente en 1 minuto.']);
        }

        return back()->withErrors(['username' => 'Credenciales incorrectas.'])
            ->with('login_attempts', $attempts);
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        session()->flush();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
