<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Socio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'apellido_paterno', 'apellido_materno',
        'email', 'telefono', 'saldo_ahorro', 'activo',
    ];

    // Relación uno a muchos con Aportaciones
    public function aportaciones()
    {
        return $this->hasMany(Aportacion::class);
    }

    // Relación uno a muchos con Préstamos
    public function prestamos()
    {
        return $this->hasMany(Prestamo::class);
    }

    // Relación uno a muchos con Abonos
    public function abonos()
    {
        return $this->hasManyThrough(Abono::class, Prestamo::class);
    }
}

