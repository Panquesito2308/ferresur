<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;

    protected $table = 'sucursales';
    protected $primaryKey = 'id_sucursal';
    public $timestamps = false;

    protected $fillable = ['nombre', 'direccion', 'telefono'];

    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'id_sucursal');
    }
    public function eventos()
    {
        return $this->hasMany(Evento::class, 'id_sucursal');
    }
}
