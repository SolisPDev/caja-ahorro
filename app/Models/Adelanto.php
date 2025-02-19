<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adelanto extends Model
{
    use HasFactory;

    protected $fillable = ['socio_id', 'monto', 'saldo_pendiente', 'quincenas', 'fecha_solicitud', 'estado'];

    // Relación con Socio (muchos a uno)
    public function socio()
    {
        return $this->belongsTo(Socio::class);
    }

    //Relación uno a muchos con Abonos
    public function abonos()
    {
        return $this->hasMany(Abono::class);
    }

}

