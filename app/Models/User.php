<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'usuarios';

    public $timestamps = false; // Agrega esta línea


    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado', 'id_empleado');
        return $this->hasOne(Empleado::class, 'id_usuario'); // Ajusta el nombre de la relación

    }
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
        return $this->hasOne(Cliente::class, 'id_usuario');
    }
    public function eventosRegistrados()
    {
        return $this->belongsToMany(Evento::class, 'registro_eventos', 'id_cliente', 'id_evento');
    }

    protected $fillable = [
        'username',
        'id_empleado',
        'id_cliente',
        'role',
        'password',

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',

    ];
}
