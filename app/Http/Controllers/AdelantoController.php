<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adelanto;
use App\Models\Socio;

class AdelantoController extends Controller
{
    /**
     * Muestra el formulario para solicitar un adelanto.
     */
    public function create($socio_id)
    {
        $socio = Socio::findOrFail($socio_id);

        return view('adelantos.create', compact('socio'));
    }

    /**
     * Almacena un nuevo adelanto.
     */
    public function store(Request $request)
    {
        $request->validate([
            'socio_id' => 'required|exists:socios,id',
            'monto' => 'required|numeric|min:1',
            'quincenas' => 'required|integer|min:1',
        ]);

        $socio = Socio::findOrFail($request->socio_id);

        // Verificar si el socio ya tiene un adelanto activo
        if ($socio->adelantos()->where('estado', 'pendiente')->exists()) {
            return redirect()->back()->with('error', 'El socio ya tiene un adelanto activo.');
        }

        // Crear el adelanto
        Adelanto::create([
            'socio_id' => $request->socio_id,
            'monto' => $request->monto,
            'quincenas' => $request->quincenas,
            'saldo_pendiente' => $request->monto,
            'estado' => 'pendiente', // Estado inicial
        ]);

        return redirect()->route('socios.index')->with('success', 'Adelanto registrado correctamente.');
    }

    /**
     * Muestra el formulario para pagar un adelanto.
     */
    public function edit($id)
    {
        $adelanto = Adelanto::findOrFail($id);
        return view('adelantos.edit', compact('adelanto'));
    }

    /**
     * Procesa los pagos del adelanto.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'pago' => 'required|numeric|min:1',
        ]);

        $adelanto = Adelanto::findOrFail($id);

        // Verificar que no exceda el saldo pendiente
        if ($request->pago > $adelanto->saldo_pendiente) {
            return redirect()->back()->with('error', 'El pago excede el saldo pendiente.');
        }

        // Restar el pago del saldo pendiente
        $adelanto->saldo_pendiente -= $request->pago;
        $adelanto->quincenas -= 1;

        // Si el saldo llega a 0, marcar como pagado
        if ($adelanto->saldo_pendiente <= 0 || $adelanto->quincenas == 0) {
            $adelanto->estado = 'pagado';
        }

        $adelanto->save();

        return redirect()->route('socios.index')->with('success', 'Pago registrado correctamente.');
    }
}

