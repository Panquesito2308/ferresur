<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventoRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Cambia a false y gestiona la autorización si es necesario
    }

    public function rules()
    {
        return [
            'tipo' => 'required|in:capacitacion,aniversario',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'cupo' => 'required|integer|min:0',
            'encargado' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'id_sucursal' => 'required|exists:sucursales,id_sucursal',
        ];
    }
}
