<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abono extends Model
{
    use HasFactory;

    protected $fillable = ['socio_id', 'adelanto_id', 'fecha', 'monto', 'saldo_restante'];

    // Relación con el socio
    public function socio()
    {
        return $this->belongsTo(Socio::class);
    }

    // Relación con el adelanto
    public function adelanto()
    {
        return $this->belongsTo(Adelanto::class);
    }
}
