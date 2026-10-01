<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    public function edit()
    {
        $usuario = Auth::user();
        return view('perfil.edit', compact('usuario'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'userame' => 'required|string|max:10',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $usuario = Auth::user();
        $usuario->username = $request->name;

        if ($request->password) {
            $usuario->password = bcrypt($request->password);
        }

        $usuario->save();

        return redirect()->route('perfil.edit')->with('success', 'Perfil actualizado correctamente.');
    }
}
