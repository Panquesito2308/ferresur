<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use App\Models\Evento;
use App\Models\Sucursal;
use Illuminate\Support\Facades\Auth;
use App\Models\RegistroEvento;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;



class EventoController extends Controller
{
    public function generarReporte()

    {
        $eventos = Evento::with('sucursal')->get();
        $pdf = PDF::loadView('administrador.evento_reporte', compact('eventos'));
        return $pdf->download('reporte_eventos.pdf');
    }

    // En EventoController.php
    public function downloadPdf(Evento $evento)
    {
        try {
            $evento->load(['registros.cliente', 'registros.empleado', 'sucursal']);
            $pdf = PDF::loadView('administrador.eventos.pdf_individual', compact('evento'))
                ->setPaper('letter', 'portrait');

            return $pdf->download("evento_{$evento->id_evento}.pdf");
        } catch (\Exception $e) {
            return back()->with('error', 'Error al generar el PDF: ' . $e->getMessage());
        }
    }


    public function index()
    {
        $eventos = Evento::with('sucursal')
            ->where('fecha_inicio', '>=', now()->toDateString())
            ->orderBy('fecha_inicio', 'asc')
            ->paginate(5);

        foreach ($eventos as $evento) {
            $evento->registrado = RegistroEvento::where('id_evento', $evento->id_evento)
                ->where(function ($query) {
                    if (Auth::user()->role === 'cliente') {
                        $query->where('id_cliente', Auth::user()->id_cliente);
                    } elseif (Auth::user()->role === 'empleado') {
                        $query->where('id_empleado', Auth::user()->id_empleado);
                    }
                })->exists();

            // Calcular cupo disponible
            // Calcular cupo disponible (usando el mismo nombre de campo en toda la app)
            $registrados = RegistroEvento::where('id_evento', $evento->id_evento)->count();
            $evento->cupo_disponible = $evento->cupo - $registrados;
            $evento->cupo_maximo = $evento->cupo; // Asegurar consistencia
        }

        if (auth::user()->role === 'administrador') {
            return view('administrador.eventos.index', compact('eventos'));
        }
        if (auth::user()->role === 'empleado') {
            return view('empleado.eventos.index', compact('eventos'));
        }
        if (auth::user()->role === 'cliente') {
            return view('cliente.eventos.index', compact('eventos'));
        }

        return redirect('/');
    }
    public function show($id)
    {
        $evento = Evento::findOrFail($id);

        return view('cliente.eventos.show', compact('evento'));
    }


    public function create()
    {
        $empleados = Empleado::with('user')
            ->whereHas('user', function ($query) {
                $query->where('role', 'administrador');
            })
            ->get();

        $sucursales = Sucursal::all();

        return view('administrador.eventos.create', compact('empleados', 'sucursales'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|string',
            'descripcion' => 'required|string',
            'fecha_inicio' => 'required|date|after_or_equal:today', // ✅ No permitir fechas anteriores
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'telefono' => 'required|regex:/^[0-9]{10}$/', // ✅ Solo 10 dígitos numéricos
            'id_sucursal' => 'required|exists:sucursales,id_sucursal',
            'cupo' => 'nullable|integer|min:1', // ✅ Cupo mínimo de 1
            'encargado' => 'nullable|string|max:100',
            'manual_encargado' => 'nullable|string|max:100',
        ]);

        $evento = new Evento();
        $evento->tipo = $request->tipo;
        $evento->descripcion = $request->descripcion;
        $evento->fecha_inicio = $request->fecha_inicio;
        $evento->fecha_fin = $request->fecha_fin;
        $evento->hora_inicio = $request->hora_inicio;
        $evento->hora_fin = $request->hora_fin;
        $evento->telefono = $request->telefono;
        $evento->id_sucursal = $request->id_sucursal;

        // Si es una capacitación, asignar cupo y encargado
        if ($request->tipo == 'capacitacion') {
            $evento->cupo = $request->cupo;

            // Si el valor de encargado es "otro", asignar el valor manual
            if ($request->encargado === 'otro') {
                $evento->encargado = $request->manual_encargado;
            } else {
                $empleado = Empleado::find($request->encargado);
                if ($empleado) {
                    $evento->encargado = $empleado->nombre . ' ' . $empleado->apellidos;
                }
            }
        }

        $evento->save();

        return redirect()->route('administrador.eventos.index')
            ->with('success', 'Evento creado exitosamente');
    }

    public function edit(Evento $evento)
    {
        $sucursales = Sucursal::all();
        $empleados = Empleado::with('user')
            ->whereHas('user', function ($query) {
                $query->where('role', 'administrador');
            })
            ->get();

        return view('administrador.eventos.edit', compact('evento', 'sucursales', 'empleados'));
    }

    public function update(Request $request, Evento $evento)
    {
        $request->validate([
            'tipo' => 'required|string|in:capacitacion,aniversario',
            'descripcion' => 'required|string|max:50',
            'fecha_inicio' => 'required|date|after_or_equal:today', // ✅ No permitir fechas anteriores
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'hora_inicio' => 'required|date_format:H:i:s',
            'hora_fin' => 'required|date_format:H:i:s|after:hora_inicio',
            'cupo' => 'nullable|integer|min:1',
            'encargado' => 'nullable|string|max:50',
            'manual_encargado' => 'nullable|required_if:encargado,otro|string|max:50',
            'telefono' => 'required|regex:/^[0-9]{10}$/', // ✅ Solo 10 dígitos numéricos
            'id_sucursal' => 'required|exists:sucursales,id_sucursal',
        ]);

        $encargado = $request->encargado;

        // Si el valor de encargado es "otro", usar el valor manual
        if ($encargado === 'otro') {
            $encargado = $request->manual_encargado;
        } else {
            $empleado = Empleado::find($encargado);
            if ($empleado) {
                $encargado = $empleado->nombre . ' ' . $empleado->apellidos;
            }
        }

        $evento->update([
            'tipo' => $request->tipo,
            'descripcion' => $request->descripcion,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            'cupo' => $request->cupo,
            'encargado' => $encargado,
            'telefono' => $request->telefono,
            'id_sucursal' => $request->id_sucursal,
        ]);

        return redirect()->route('administrador.eventos.index')
            ->with('success', 'Evento actualizado correctamente.');
    }

    public function destroy(Evento $evento)
    {
        $evento->delete();

        return redirect()->route('administrador.eventos.index')
            ->with('success', 'Evento eliminado correctamente.');
    }
    public function historial()
    {
        $eventos = Evento::with(['sucursal', 'registros.cliente', 'registros.empleado'])
            ->orderBy('fecha_inicio', 'asc')
            ->get();

        return view('administrador.eventos.historial', compact('eventos'));
    }
    public function historialEventosCliente()
    {


        $cliente = Auth::user()->cliente;

        // Obtener solo los eventos en los que el cliente está registrado
        $eventos = $cliente->eventosRegistrados()
            ->orderBy('fecha_inicio', 'asc')
            ->get();

        return view('cliente.eventos.historial', compact('eventos'));
    }

    public function historialEventosEmpleado()
    {
        $empleado = Auth::user()->empleado;

        // Obtener solo los eventos en los que el empleado está registrado
        $eventos = $empleado->eventosRegistrados()
            ->orderBy('fecha_inicio', 'asc')
            ->get();

        return view('empleado.eventos.historial', compact('eventos'));
    }
    public function generarReporteHistorial()
    {
        $eventos = Evento::with(['sucursal', 'registros.cliente', 'registros.empleado'])
            ->orderBy('fecha_inicio', 'asc')
            ->get();

        $pdf = PDF::loadView('administrador.eventos.reporte_historial', compact('eventos'));
        return $pdf->download('reporte_historial_eventos.pdf');
    }

    public function generarReporteHistorialCliente()
    {
        $cliente = Auth::user()->cliente;
        $eventos = $cliente->eventosRegistrados()
            ->orderBy('fecha_inicio', 'asc')
            ->get();

        $pdf = PDF::loadView('cliente.eventos.reporte_historial', compact('eventos'));
        return $pdf->download('reporte_historial_eventos_cliente.pdf');
    }
}
