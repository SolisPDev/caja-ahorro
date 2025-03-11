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
    //public function index()
    //{
    //    $aportaciones = Aportacion::with('socio')->orderBy('fecha_pago', 'desc')->get();
    //    return view('aportaciones.index', compact('aportaciones'));
    //}

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
    

    public function showBySocio($socioId)
    {
        $socio = Socio::findOrFail($socioId);
        $aportaciones = $socio->aportaciones()->orderBy('fecha_pago', 'desc')->get();

        return view('aportaciones.socio', compact('socio', 'aportaciones'));
    }

    /**
     * Muestra la vista para generar aportaciones automáticamente.
     */
    public function generarAportacionesView()
    {
        return view('aportaciones.generar');
    }

    /**
     * Genera aportaciones para todos los socios basándose en su última aportación.
     */
    public function generarAportaciones(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
        ]);

        $fecha = $request->fecha;

        DB::transaction(function () use ($fecha) {
            $socios = Socio::all();
            
            foreach ($socios as $socio) {
                $ultimaAportacion = $socio->aportaciones()->latest('fecha_pago')->first();
                
                if ($ultimaAportacion) {
                    Aportacion::create([
                        'socio_id' => $socio->id,
                        'fecha_pago' => $fecha,
                        'monto' => $ultimaAportacion->monto,
                    ]);

                    // Actualizar saldo de ahorro del socio
                    $socio->saldo_ahorro += $ultimaAportacion->monto;
                    $socio->save();
                }
            }
        });

        return redirect()->route('dashboard')->with('success', 'Aportaciones generadas correctamente.');
    }

}
