<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

    protected $fillable = [
        'socio_id', 
        'fecha_solicitud', 
        'fecha_inicio', 
        'monto', 
        'tasa_interes', 
        'total_pagar', 
        'quincenas', 
        'saldo_pendiente', 
        'estado'
    ];

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

    // Método para calcular el total a pagar basado en el monto y la tasa de interés
    public function calcularTotalPagar()
    {
        return $this->monto + ($this->monto * ($this->tasa_interes / 100));
    }

    // Método para verificar si el préstamo sigue activo
    public function estaActivo()
    {
        return $this->estado === 'Activo';
    }

    // Método para calcular el monto por quincena
    public function calcularPagoQuincenal()
    {
        return $this->total_pagar / $this->quincenas;
    }
}
