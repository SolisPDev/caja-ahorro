<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aportacion;
use App\Models\Socio;
use Illuminate\Support\Facades\DB;

class AportacionController extends Controller
{
    /**
     * Muestra la lista de aportaciones.
     */
    public function index()
    {
        $aportaciones = Aportacion::with('socio')->orderBy('fecha_pago', 'desc')->get();
        return view('aportaciones.index', compact('aportaciones'));
    }

    /**
     * Muestra el formulario para crear una nueva aportación.
     */
    public function create($socio_id)
    {
        $socio = Socio::findOrFail($socio_id);
        return view('aportaciones.create', compact('socio'));
    }

    /**
     * Almacena una nueva aportación en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'socio_id' => 'required|exists:socios,id',
            'monto' => 'required|numeric|min:1',
            'fecha_pago' => 'required|date',
        ]);

        DB::transaction(function () use ($request) {
            // Registrar la aportación
            $aportacion = Aportacion::create([
                'socio_id' => $request->socio_id,
                'monto' => $request->monto,
                'fecha_pago' => $request->fecha_pago,
            ]);

            // Actualizar el saldo del socio
            $socio = Socio::findOrFail($request->socio_id);
            $socio->saldo_ahorro += $request->monto;
            $socio->save();
        });

        return redirect()->route('aportaciones.socio', $request->socio_id)
                     ->with('success', 'Aportación registrada correctamente.');
    }

    /**
     * Muestra los detalles de una aportación específica.
     */
    public function show(Aportacion $aportacion)
    {
        return view('aportaciones.show', compact('aportacion'));
    }

    /**
     * Muestra el formulario para editar una aportación.
     */
    public function edit(Aportacion $aportacion)
    {
        return view('aportaciones.edit', compact('aportacion'));
    }

    /**
     * Actualiza una aportación en la base de datos.
     */
    public function update(Request $request, Aportacion $aportacion)
    {
        $request->validate([
            'monto' => 'required|numeric|min:1',
            'fecha_pago' => 'required|date',
        ]);

        DB::transaction(function () use ($request, $aportacion) {
            $socio = $aportacion->socio;

            // Restar el monto anterior del saldo del socio
            $socio->saldo_ahorro -= $aportacion->monto;

            // Actualizar la aportación
            $aportacion->update($request->all());

            // Sumar el nuevo monto al saldo del socio
            $socio->saldo_ahorro += $request->monto;
            $socio->save();
        });

        return redirect()->route('aportaciones.index')->with('success', 'Aportación actualizada correctamente.');
    }

    /**
     * Elimina una aportación de la base de datos.
     */
    public function destroy(Aportacion $aportacion)
    {
        DB::transaction(function () use ($aportacion) {
            $socio = $aportacion->socio;

            // Restar el monto de la aportación eliminada del saldo del socio
            $socio->saldo_ahorro -= $aportacion->monto;
            $socio->save();

            // Eliminar la aportación
            $aportacion->delete();
        });

        return redirect()->route('aportaciones.index')->with('success', 'Aportación eliminada correctamente.');
    }

    public function showBySocio($socioId)
    {
        $socio = Socio::findOrFail($socioId);
        $aportaciones = $socio->aportaciones()->orderBy('fecha_pago', 'desc')->get();

        return view('aportaciones.socio', compact('socio', 'aportaciones'));
    }

}
