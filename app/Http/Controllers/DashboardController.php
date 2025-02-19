<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Socio;
use App\Models\Adelanto;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtener el saldo total de ahorro de todos los socios
        $saldoTotalAhorro = Socio::sum('saldo_ahorro');
        $sociosActivos = Socio::count();
        $adelantosQuincenasActivos = Adelanto::count();

        return view('dashboard', compact('saldoTotalAhorro',
                                        'sociosActivos',
                                        'adelantosQuincenasActivos'));
    }
}
