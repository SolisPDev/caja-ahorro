<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Socio;
use App\Models\Prestamo;


class DashboardController extends Controller
{
    public function index()
    {
        // Obtener el saldo total de ahorro de todos los socios
        $saldoTotalAhorro = Socio::sum('saldo_ahorro');
        $sociosActivos = Socio::count();

        // Contar préstamos que no están pagados
        $prestamosNoPagados = Prestamo::where('estado', '!=', 'Pagado')->count();
       

        return view('dashboard', compact('saldoTotalAhorro',
                                        'sociosActivos',
                                        'prestamosNoPagados'
                                        ));
    }
}
