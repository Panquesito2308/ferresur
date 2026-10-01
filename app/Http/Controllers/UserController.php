<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Empleado; // Importa el modelo Empleado
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('empleado')->paginate(6);;
        return view('administrador.users.index', compact('users'));
    }
    public function create()
    {
        $empleados = Empleado::doesntHave('user')->get(); // Obtener solo empleados sin usuario
        return view('administrador.users.create', compact('empleados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:10|unique:usuarios', // Corrección aquí
            'id_empleado' => 'required|exists:empleados,id_empleado|unique:usuarios,id_empleado', // Corrección aquí
            'role' => ['required', 'string', Rule::in(['administrador', 'empleado'])],
            'password' => 'required|string|max:8|confirmed',
        ]);



        User::create([
            'username' => $request->username,
            'id_empleado' => $request->id_empleado,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('administrador.users.index')->with('success', 'Usuario creado correctamente.');
    }

    public function edit(User $user)
    {
        $empleados = Empleado::all(); // Obtener todos los empleados
        return view('administrador.users.edit', compact('user', 'empleados'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required|string|max:10|unique:usuarios,username,' . $user->id, // Corrección aquí
            'id_empleado' => 'required|exists:empleados,id_empleado|unique:usuarios,id_empleado,' . $user->id, // Corrección aquí
            'role' => ['required', 'string', Rule::in(['administrador', 'empleado'])],
            'password' => 'nullable|string|min:8|confirmed',
        ]);


        $user->username = $request->username;
        $user->id_empleado = $request->id_empleado;
        $user->role = $request->role;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('administrador.users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('administrador.users.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
