<?php

namespace App\Http\Controllers\Cliente;

use App\Models\RegistroEvento;
use App\Models\Evento;
use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegistroEventoController extends Controller
{
    // Mostrar eventos disponibles
    public function index()
    {
        $eventos = Evento::all(); // Obtener todos los eventos disponibles
        return view('cliente.eventos.index', compact('eventos'));
    }

    // Mostrar formulario para registrarse en un evento
    public function create($id_evento)
    {
        $evento = Evento::findOrFail($id_evento); // Obtener el evento
        return view('cliente.registros.create', compact('evento'));
    }

    // Almacenar el registro del cliente en el evento
    public function store(Request $request, $id_evento)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'edad' => 'required|integer|min:0',
        ]);

        // Registrar al cliente en el evento
        RegistroEvento::create([
            'id_evento' => $id_evento,
            'nombre' => $request->nombre,
            'edad' => $request->edad,
        ]);

        return redirect()->route('cliente.eventos.index')->with('success', 'Te has registrado al evento correctamente.');
    }
}
