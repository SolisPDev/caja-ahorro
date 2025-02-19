<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aportacion extends Model
{
    use HasFactory;

    protected $fillable = ['socio_id', 'fecha_pago', 'monto'];

    // Relación con Socio (muchos a uno)
    public function socio()
    {
        return $this->belongsTo(Socio::class);
    }
}

