<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Abono;
use App\Models\Socio;
use App\Models\Prestamo;
use Carbon\Carbon;

class AbonoController extends Controller
{
    /**
     * Muestra la lista de abonos por socio.
     */
    public function index($socio_id)
    {
        $socio = Socio::findOrFail($socio_id);
        $abonos = $socio->abonos()->with('prestamo')->orderBy('fecha', 'desc')->get();

        return view('abonos.index', compact('socio', 'abonos'));
    }

    /**
     * Muestra el formulario para crear un nuevo abono.
     */
    public function create($prestamo_id)
{
    $prestamo = Prestamo::findOrFail($prestamo_id);
    $socio = $prestamo->socio; // Obtiene el socio asociado al préstamo

    // Verificar que el préstamo no esté liquidado
    if ($prestamo->saldo_pendiente <= 0) {
        return redirect()->route('prestamos.index')->with('error', 'Este préstamo ya está liquidado.');
    }

    return view('abonos.create', compact('prestamo', 'socio')); // Ahora se pasa también $socio
}

    
    /**
     * Almacena un nuevo abono y actualiza el saldo del adelanto.
    */
    
    public function store(Request $request)
    {
        $request->validate([
            'prestamo_id' => 'required|exists:prestamos,id',
            'monto' => 'required|numeric|min:1',
            'fecha' => 'required|date',
        ]);

        $prestamo = Prestamo::findOrFail($request->prestamo_id);
        $socio = $prestamo->socio;

        // Verificar que el monto no supere el saldo
        $nuevoSaldo = $prestamo->saldo_pendiente - $request->monto;
        if ($nuevoSaldo < 0) {
            return redirect()->back()->with('error', 'El monto del abono no puede ser mayor al saldo pendiente.');
        }

        // Crear el abono
        Abono::create([
            'socio_id' => $socio->id,
            'prestamo_id' => $prestamo->id,
            'fecha' => $request->fecha,
            'monto' => $request->monto,
            'saldo_restante' => $nuevoSaldo,
        ]);

        // Actualizar saldo del préstamo
        $prestamo->update(['saldo_pendiente' => $nuevoSaldo]);

        // Si el saldo llega a 0, marcar el préstamo como pagado
        if ($nuevoSaldo == 0) {
            $prestamo->update(['estado' => 'Pagado']);
        }

        return redirect()->route('prestamos.show', $prestamo->id)->with('success', 'Abono registrado correctamente.');
    }

    /**
     * Muestra los detalles de un abono.
     */
    public function show($id)
    {
        $abono = Abono::with('socio', 'prestamo')->findOrFail($id);
        return view('abonos.show', compact('abono'));
    }



    /**
     * Muestra el formulario para editar un abono.
     */
    public function edit($id)
    {
        $abono = Abono::findOrFail($id);
        return view('abonos.edit', compact('abono'));
    }

    /**
     * Actualiza un abono en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'monto' => 'required|numeric|min:1',
        ]);

        $abono = Abono::findOrFail($id);
        $adelanto = $abono->adelanto;
        $socio = $abono->socio;

        // Verifica que el nuevo monto no supere el saldo restante
        if ($request->monto > ($adelanto->saldo_pendiente + $abono->monto)) {
            return redirect()->back()->with('error', 'El monto del abono no puede superar el saldo pendiente.');
        }

        // Actualizar el saldo pendiente del adelanto
        $nuevoSaldo = ($adelanto->saldo_pendiente + $abono->monto) - $request->monto;
        $adelanto->update(['saldo_pendiente' => $nuevoSaldo]);

        // Actualizar el abono
        $abono->update([
            'monto' => $request->monto,
            'saldo_restante' => $nuevoSaldo,
        ]);

        // Si el saldo pendiente llega a 0, marcar el adelanto como liquidado
        if ($nuevoSaldo <= 0) {
            $adelanto->update(['estado' => 'pagado']);
        }

        return redirect()->route('prestamos.socios', $socio->id)
                         ->with('success', 'Abono actualizado correctamente.');
    }

    /**
     * Elimina un abono y ajusta el saldo del adelanto.
     */
    
}
