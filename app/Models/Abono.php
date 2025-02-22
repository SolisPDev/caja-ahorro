<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abono extends Model
{
    use HasFactory;

    protected $fillable = ['socio_id', 'prestamo_id', 'fecha', 'monto', 'saldo_restante'];

    // Relación con Socio
    public function socio()
    {
        return $this->belongsTo(Socio::class);
    }

    // Relación con Préstamo
    public function prestamo()
    {
        return $this->belongsTo(Prestamo::class);
    }
}
