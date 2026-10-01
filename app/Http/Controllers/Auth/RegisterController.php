<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario; // Modelo para la tabla `usuarios`
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
            'codigo_postal' => 'required|string|max:10',
            'fecha_nacimiento' => 'required|date',
            'username' => 'required|string|max:255|unique:usuarios,username',
            'password' => 'required|string|min:6|confirmed',
        ]);

        try {
            DB::beginTransaction(); // Inicia la transacción

            // ✅ 1. Crear el cliente primero
            $cliente = Cliente::create([
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'ciudad' => $request->ciudad,
                'estado' => $request->estado,
                'codigo_postal' => $request->codigo_postal,
                'fecha_nacimiento' => $request->fecha_nacimiento,
            ]);

            // ✅ 2. Luego crear el usuario con el id_cliente ya definido
            $usuario = User::create([
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'id_cliente' => $cliente->id_cliente, // Ahora sí está definido correctamente
                'role' => 'cliente',
            ]);

            DB::commit(); // Confirma la transacción

            // ✅ 3. Autenticar automáticamente al usuario
            Auth::login($usuario);

            return redirect('/cliente/dashboard')->with('success', 'Registro exitoso');
        } catch (\Exception $e) {
            DB::rollBack(); // Revierte la transacción si algo falla
            return back()->withErrors(['error' => 'Hubo un error en el registro: ' . $e->getMessage()]);
        }
    }
}
