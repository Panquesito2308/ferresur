<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;


class Cliente extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'clientes';
    protected $primaryKey = 'id_cliente';
    public $timestamps = false; // Desactiva los timestamps si no los usas


    protected $fillable = [
        'username', // Agregado el campo username
        'nombre',
        'apellidos',
        'password',
        'telefono',
        'direccion',
        'ciudad',
        'estado',
        'codigo_postal',
        'fecha_nacimiento',
        'edad'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function getAuthIdentifierName()
    {
        return 'id_cliente';
    }
    public function usuario()
    {
        return $this->hasOne(User::class, 'id_cliente');
    }
    public function getEdadAttribute()
    {
        return Carbon::parse($this->fecha_nacimiento)->age;
        return $this->belongsTo(User::class, 'id_usuario', 'id_usuario');
    }

    public function eventosRegistrados()
    {
        return $this->belongsToMany(Evento::class, 'registro_eventos', 'id_cliente', 'id_evento')
            ->withPivot('id_cliente', 'id_evento'); // Eliminar 'created_at' y 'updated_at'
    }
}
