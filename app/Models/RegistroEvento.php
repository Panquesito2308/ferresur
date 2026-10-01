<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroEvento extends Model
{
    use HasFactory;

    protected $table = 'registro_eventos';
    protected $primaryKey = 'id_registro';
    public $timestamps = false;

    protected $fillable = [
        'id_evento',
        'id_cliente',
        'id_empleado',
        'nombre',
        'edad',
        'fecha_registro'
    ];

    public function evento()
    {
        return $this->belongsTo(Evento::class, 'id_evento');
    }
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado', 'id_empleado');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }
}
