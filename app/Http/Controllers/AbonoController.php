<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Abono;
use App\Models\Socio;
use App\Models\Adelanto;

class AbonoController extends Controller
{

    /**
     * Muestra la lista de abonos por socio.
     */
    public function index($socio_id)
    {
        $socio = Socio::findOrFail($socio_id);
        $abonos = $socio->abonos()->with('adelanto')->orderBy('fecha', 'desc')->get();
        
        return view('abonos.index', compact('socio', 'abonos'));
    }

    /**
     * Muestra el formulario para crear un nuevo abono.
     */
    public function create($adelanto_id)
    {
        // Buscar el adelanto por su ID
        $adelanto = Adelanto::findOrFail($adelanto_id);

        // Obtener el socio relacionado con este adelanto
        $socio = $adelanto->socio;

        return view('adelantos.abonos.create', compact('adelanto', 'socio'));
    }


    /**
     * Almacena un nuevo abono y actualiza el saldo del adelanto.
    */
    public function store(Request $request, $adelanto_id)
    {
        try {
            // Validación de entrada
            $request->validate([
                'monto' => 'required|numeric|min:1',
                'fecha' => 'required|date',
            ]);

            // Buscar el adelanto y su socio
            $adelanto = Adelanto::findOrFail($adelanto_id);
            $socio = $adelanto->socio;

            // Verifica que el abono no supere el saldo pendiente
            if ($request->monto > $adelanto->saldo_pendiente) {
                return redirect()->back()->with('error', 'El monto del abono no puede superar el saldo pendiente.');
            }

            // Calcular nuevo saldo
            $nuevoSaldo = $adelanto->saldo_pendiente - $request->monto;

            // Registrar el abono
            Abono::create([
                'socio_id' => $socio->id,
                'adelanto_id' => $adelanto->id,
                'fecha' => $request->fecha, // Usar la fecha proporcionada en el formulario
                'monto' => $request->monto,
                'saldo_restante' => $nuevoSaldo,
            ]);

            // Actualizar saldo pendiente del adelanto
            $adelanto->update(['saldo_pendiente' => $nuevoSaldo]);

            // Si el saldo pendiente es 0, marcar el adelanto como pagado
            if ($nuevoSaldo <= 0) {
                $adelanto->update(['estado' => 'pagado']); // Cambio de 'estatus' a 'estado'
            }

            return redirect()->route('adelantos.activos', $adelanto->id)
                            ->with('success', 'Abono registrado correctamente.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al registrar el abono: ' . $e->getMessage());
        }
    }



    /**
     * Muestra los detalles de un abono.
     */
    public function show($id)
    {
        $abono = Abono::with('socio', 'adelanto')->findOrFail($id);
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
            $adelanto->update(['estatus' => 'LIQUIDADO']);
        }

        return redirect()->route('abonos.index', $socio->id)
                         ->with('success', 'Abono actualizado correctamente.');
    }

    /**
     * Elimina un abono y ajusta el saldo del adelanto.
     */
    public function destroy($id)
    {
        $abono = Abono::findOrFail($id);
        $adelanto = $abono->adelanto;
        $socio = $abono->socio;

        // Revertir el saldo pendiente del adelanto
        $nuevoSaldo = $adelanto->saldo_pendiente + $abono->monto;
        $adelanto->update(['saldo_pendiente' => $nuevoSaldo]);

        // Si se eliminó un abono, el adelanto deja de estar liquidado
        if ($adelanto->estatus === 'LIQUIDADO') {
            $adelanto->update(['estatus' => 'ACTIVO']);
        }

        // Eliminar el abono
        $abono->delete();

        return redirect()->route('abonos.index', $socio->id)
                         ->with('success', 'Abono eliminado correctamente.');
    }
}
