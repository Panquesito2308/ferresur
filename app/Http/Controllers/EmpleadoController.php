<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\User;
use App\Models\Sucursal;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class EmpleadoController extends Controller
{
    // Métodos de vistas
    public function dashboard()
    {
        return view('empleado.dashboard');
    }

    public function index()
    {
        $empleados = Empleado::with(['sucursal', 'user'])
            ->orderBy('apellidos', 'asc')
            ->paginate(6);

        return view('administrador.empleados.index', compact('empleados'));
    }

    public function create()
    {
        $sucursales = Sucursal::all();
        return view('administrador.empleados.create', compact('sucursales'));
    }

    public function edit($id_empleado)
    {
        $empleado = Empleado::with('user')->findOrFail($id_empleado);
        $sucursales = Sucursal::all();

        return view('administrador.empleados.edit', compact('empleado', 'sucursales'));
    }

    // Métodos de operaciones CRUD
    public function store(Request $request)
    {
        $request->validate([
            // Validación para empleado
            'nombre' => 'required|string|max:50',
            'apellidos' => 'required|string|max:50',
            'fecha_nacimiento' => ['required', 'date', function ($attribute, $value, $fail) {
                if (Carbon::parse($value)->age < 18) {
                    $fail('El empleado debe tener al menos 18 años.');
                }
            }],
            'id_sucursal' => 'required|exists:sucursales,id_sucursal',
            'numero_unidad' => 'nullable|string|max:11',
            'telefono' => 'required|string|size:10|regex:/^[0-9]+$/',

            // Validación para usuario
            'username' => 'required|string|max:10|unique:usuarios',
            'password' => 'required|string|min:8|max:8|confirmed',
            'role' => ['required', 'string', Rule::in(['administrador', 'empleado'])]
        ]);

        DB::transaction(function () use ($request) {
            // Calcular edad automáticamente
            $edad = Carbon::parse($request->fecha_nacimiento)->age;

            $empleado = Empleado::create([
                'nombre' => $this->formatName($request->nombre),
                'apellidos' => $this->formatName($request->apellidos),
                'edad' => $edad,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'numero_unidad' => $request->numero_unidad,
                'id_sucursal' => $request->id_sucursal,
                'telefono' => $request->telefono,

            ]);

            User::create([
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'id_empleado' => $empleado->id_empleado
            ]);
        });

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado registrado exitosamente');
    }

    public function update(Request $request, Empleado $empleado)
    {
        $request->validate([
            // Validación para empleado
            'nombre' => 'required|string|max:50',
            'apellidos' => 'required|string|max:50',
            'fecha_nacimiento' => ['required', 'date', function ($attribute, $value, $fail) {
                if (Carbon::parse($value)->age < 18) {
                    $fail('El empleado debe tener al menos 18 años.');
                }
            }],
            'id_sucursal' => 'required|exists:sucursales,id_sucursal',
            'numero_unidad' => 'nullable|string|max:11',
            'telefono' => 'required|string|size:10|regex:/^[0-9]+$/',


            // Validación para usuario
            'username' => 'required|string|max:10|unique:usuarios,username,' . $empleado->user->id,
            'role' => ['required', 'string', Rule::in(['administrador', 'empleado'])],
            'password' => 'nullable|string|min:8|max:10|confirmed'
        ]);

        DB::transaction(function () use ($request, $empleado) {
            // Calcular edad automáticamente
            $edad = Carbon::parse($request->fecha_nacimiento)->age;

            $empleado->update([
                'nombre' => $this->formatName($request->nombre),
                'apellidos' => $this->formatName($request->apellidos),
                'edad' => $edad,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'numero_unidad' => $request->numero_unidad,
                'id_sucursal' => $request->id_sucursal,
                'telefono' => $request->telefono,
            ]);

            $userData = [
                'username' => $request->username,
                'role' => $request->role
            ];

            if ($request->password) {
                $userData['password'] = Hash::make($request->password);
            }

            $empleado->user->update($userData);
        });

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado actualizado exitosamente');
    }

    public function destroy(Empleado $empleado)
    {
        DB::transaction(function () use ($empleado) {
            // Eliminar usuario asociado primero
            if ($empleado->user) {
                $empleado->user->delete();
            }

            // Luego eliminar el empleado
            $empleado->delete();
        });

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado eliminado correctamente');
    }

    // Métodos adicionales
    public function generarReporte()
    {
        $empleados = Empleado::with(['sucursal', 'user'])->get();
        $pdf = PDF::loadView('administrador.empleados_reporte', compact('empleados'));
        return $pdf->download('reporte_empleados_' . now()->format('Ymd') . '.pdf');
    }

    // Métodos auxiliares
    private function formatName($name)
    {
        return ucwords(strtolower($name));
    }
}
