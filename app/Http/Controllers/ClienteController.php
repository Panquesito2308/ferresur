<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Cliente;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ClienteController extends Controller
{
    public function generarReporte()
    {
        $clientes = Cliente::with('usuario')->get();
        $pdf = PDF::loadView('administrador.clientes_reportes', compact('clientes'));
        return $pdf->download('reporte_clientes.pdf');
    }

    public function dashboard()
    {
        return view('cliente.dashboard');
    }

    public function eventos()
    {
        return view('cliente.eventos');
    }

    public function compras()
    {
        return view('cliente.compras');
    }

    public function misEventos()
    {
        $cliente = Auth::guard('cliente')->user();
        $registros = \App\Models\RegistroEvento::where('id_cliente', $cliente->id_cliente)
            ->with('evento')
            ->get();

        return view('cliente.mis_eventos', compact('registros'));
    }

    public function index()
    {
        $clientes = Cliente::with('usuario')->paginate(10);
        return view('administrador.clientes.index', compact('clientes'));
    }
    public function create()
    {
        return view('administrador.clientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:10|unique:usuarios,username',
            'nombre' => 'required|string|max:50',
            'apellidos' => 'required|string|max:50',
            'password' => 'required|string|min:8|max:10',
            'telefono' => 'required|string|max:10',
            'direccion' => 'required|string|max:100',
            'ciudad' => 'required|string|max:20',
            'estado' => 'required|string|max:20',
            'codigo_postal' => 'required|string|max:6',
            'fecha_nacimiento' => 'required|date',
        ]);

        try {
            DB::beginTransaction();

            // Crear usuario primero
            $usuario = User::create([
                'username' => $request->username,
                'password' => bcrypt($request->password)
            ]);

            // Crear cliente asociado
            Cliente::create([
                'id_usuario' => $usuario->id,
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'ciudad' => $request->ciudad,
                'estado' => $request->estado,
                'codigo_postal' => $request->codigo_postal,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'edad' => Carbon::parse($request->fecha_nacimiento)->age
            ]);

            DB::commit();
            return redirect()->route('administrador.clientes.index')->with('success', 'Cliente creado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al crear el cliente: ' . $e->getMessage());
        }
    }

    public function edit(Cliente $cliente)
    {
        return view('administrador.clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'apellidos' => 'required|string|max:50',
            'telefono' => 'required|string|max:10',
            'direccion' => 'required|string|max:100',
            'ciudad' => 'required|string|max:20',
            'estado' => 'required|string|max:20',
            'codigo_postal' => 'required|string|max:6',
            'fecha_nacimiento' => 'required|date',
        ]);

        try {
            DB::beginTransaction();

            $cliente->update([
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'ciudad' => $request->ciudad,
                'estado' => $request->estado,
                'codigo_postal' => $request->codigo_postal,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'edad' => Carbon::parse($request->fecha_nacimiento)->age
            ]);

            DB::commit();
            return redirect()->route('administrador.clientes.index')->with('success', 'Cliente actualizado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al actualizar el cliente: ' . $e->getMessage());
        }
    }

    public function destroy(Cliente $cliente)
    {
        try {
            // Eliminar usuario asociado primero
            $cliente->usuario()->delete();

            // Luego eliminar el cliente
            $cliente->delete();

            return redirect()->route('administrador.clientes.index')->with('success', 'Cliente eliminado correctamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar el cliente: ' . $e->getMessage());
        }
    }
}
