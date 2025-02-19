<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

    protected $fillable = ['socio_id', 'fecha_solicitud', 'monto', 'tasa_interes', 'saldo_pendiente', 'estado'];

    // Relación con Socio (muchos a uno)
    public function socio()
    {
        return $this->belongsTo(Socio::class);
    }

    // Relación uno a muchos con Pagos de Préstamo
    public function pagos()
    {
        return $this->hasMany(PagoPrestamo::class);
    }
}

