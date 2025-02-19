<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoPrestamo extends Model
{
    use HasFactory;

    protected $fillable = ['prestamo_id', 'fecha_pago', 'monto_capital', 'monto_interes'];

    // Relación con Préstamo (muchos a uno)
    public function prestamo()
    {
        return $this->belongsTo(Prestamo::class);
    }
}
