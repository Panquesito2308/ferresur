<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // Crea una vista cliente.login.blade.php
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::guard('cliente')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/cliente/dashboard'); // Redirige al dashboard de clientes
        }

        return back()->withErrors([
            'username' => 'Las credenciales proporcionadas son incorrectas.',
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->forget('key');

        return redirect('/');
    }
}
