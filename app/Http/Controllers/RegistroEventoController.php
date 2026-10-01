<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\RegistroEvento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegistroEventoController extends Controller
{
    public function registrarEvento(Request $request, $eventoId)
    {
        DB::beginTransaction();

        // Obtener el cliente o empleado autenticado
        if (Auth::user()->role == 'cliente') {
            $cliente = Auth::user();
            $empleado = null;
        } else {
            $empleado = Auth::user();
            $cliente = null;
        }

        if (!$cliente && !$empleado) {
            return back()->with('error', 'No se encontró el usuario autenticado.');
        }

        // Buscar el evento por su ID
        $evento = Evento::findOrFail($eventoId);
        // Solo permitir registro para eventos de tipo "capacitacion"
        if ($evento->tipo !== 'capacitacion') {
            return back()->with('error', 'Solo puedes registrarte en eventos de tipo capacitación.');
        }

        // Verificar si ya está registrado
        $registroExistente = RegistroEvento::where('id_evento', $evento->id_evento)
            ->where(function ($query) use ($cliente, $empleado) {
                if ($cliente) {
                    $query->where('id_cliente', $cliente->id_cliente);
                }
                if ($empleado) {
                    $query->where('id_empleado', $empleado->id_empleado);
                }
            })->exists();

        if ($registroExistente) {
            return back()->with('error', 'Ya estás registrado en este evento.');
        }

        // Si no está registrado, procedemos a crear el registro
        RegistroEvento::create([
            'id_evento' => $evento->id_evento,
            'id_cliente' => $cliente ? $cliente->id_cliente : null,
            'id_empleado' => $empleado ? $empleado->id_empleado : null,
            'nombre' => ($cliente ? $cliente->cliente->nombre : ($empleado ? $empleado->empleado->nombre : null)),
            'fecha_registro' => now(),
        ]);

        DB::commit();

        // Redirigir según el rol del usuario
        if (Auth::user()->role == 'cliente') {
            return redirect()->route('cliente.eventos.index')->with('success', 'Registro al evento exitoso.');
        } else {
            return redirect()->route('empleado.eventos.index')->with('success', 'Registro al evento exitoso.');
        }
    }
    public function cancelarRegistro($eventoId)
    {
        DB::beginTransaction();

        try {
            // Obtener el cliente o empleado autenticado
            if (Auth::user()->role == 'cliente') {
                $cliente = Auth::user();
                $empleado = null;
            } else {
                $empleado = Auth::user();
                $cliente = null;
            }

            if (!$cliente && !$empleado) {
                return back()->with('error', 'No se encontró el usuario autenticado.');
            }

            // Buscar el registro del evento
            $registro = RegistroEvento::where('id_evento', $eventoId)
                ->where(function ($query) use ($cliente, $empleado) {
                    if ($cliente) {
                        $query->where('id_cliente', $cliente->id_cliente);
                    }
                    if ($empleado) {
                        $query->where('id_empleado', $empleado->id_empleado);
                    }
                })->first();

            if (!$registro) {
                return back()->with('error', 'No se encontró el registro del evento.');
            }

            // Eliminar el registro del evento
            $registro->delete();

            DB::commit();

            return back()->with('success', 'Tu registro ha sido cancelado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al cancelar el registro: ' . $e->getMessage());
        }
    }
}
