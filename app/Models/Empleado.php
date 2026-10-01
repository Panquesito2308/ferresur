<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados'; // Especifica el nombre de la tabla
    protected $primaryKey = 'id_empleado'; // Especifica el nombre de la clave primaria
    public $timestamps = false; // Desactiva los timestamps si no los usas

    protected $fillable = [
        'nombre',
        'apellidos',
        'edad',
        'fecha_nacimiento',
        'numero_unidad',
        'id_sucursal', // Asegúrate de que este campo esté aquí
        'telefono',
        'estatus' // 'activo' o 'inactivo'

    ];
    // Scope para filtrar activos
    public function scopeActivos($query)
    {
        return $query->where('estatus', 'activo');
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'id_sucursal');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id_empleado');
    }
    public function eventosRegistrados()
    {
        return $this->belongsToMany(Evento::class, 'registro_eventos', 'id_empleado', 'id_evento')
            ->withPivot('fecha_registro');
    }
}
