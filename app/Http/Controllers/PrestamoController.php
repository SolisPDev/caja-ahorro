<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Prestamo;
use App\Models\Socio;

class PrestamoController extends Controller
{
    /**
     * Muestra la lista de préstamos.
     */
    public function index()
    {
        $prestamos = Prestamo::with('socio')->get();
        return view('prestamos.index', compact('prestamos'));
    }

    /**
     * Muestra el formulario para solicitar un nuevo préstamo.
     */
    public function create($socio_id)
    {
        $socio = Socio::findOrFail($socio_id);

        //Verificar si el socio ya tiene un préstamo activo
        //if ($socio->prestamos()->where('estado', 'Activo')->exists()) {
        //    return redirect()->route('prestamos.index')
        //        ->with('error', 'El socio ya tiene un préstamo activo.');
        //}

        return view('prestamos.create', compact('socio'));
    }

    /**
     * Guarda un nuevo préstamo en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'socio_id' => 'required|exists:socios,id',
            'monto' => 'required|numeric|min:1',
            'tasa_interes' => 'required|numeric|min:0',
            'quincenas' => 'required|integer|min:1',
            'fecha_inicio' => 'required|date',
        ]);

        $socio = Socio::findOrFail($request->socio_id);

        // Verificar si el socio ya tiene un préstamo activo
        //if ($socio->prestamos()->where('estado', 'Activo')->exists()) {
        //    return redirect()->back()->with('error', 'El socio ya tiene un préstamo activo.');
        //}

        // Calcular el total a pagar con interés
        $total_pagar = $request->monto + ($request->monto * ($request->tasa_interes / 100));

        // Crear el préstamo
        Prestamo::create([
            'socio_id' => $request->socio_id,
            'fecha_solicitud' => now(),
            'fecha_inicio' => $request->fecha_inicio,
            'monto' => $request->monto,
            'tasa_interes' => $request->tasa_interes,
            'total_pagar' => $total_pagar,
            'quincenas' => $request->quincenas,
            'saldo_pendiente' => $total_pagar,
            'estado' => 'Activo',
        ]);

        return redirect()->route('prestamos.index')
            ->with('success', 'Préstamo registrado correctamente.');
    }

    /**
     * Muestra los detalles de un préstamo específico.
     */
    public function show($id)
    {
        $prestamo = Prestamo::with('socio', 'abonos')->findOrFail($id);
        return view('prestamos.show', compact('prestamo'));
    }

    /**
     * Muestra el formulario para editar un préstamo.
     */
    public function edit($id)
    {
        $prestamo = Prestamo::findOrFail($id);
        return view('prestamos.edit', compact('prestamo'));
    }

    /**
     * Actualiza la información de un préstamo.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'monto' => 'required|numeric|min:1',
            'tasa_interes' => 'required|numeric|min:0',
            'quincenas' => 'required|integer|min:1',
            'fecha_inicio' => 'required|date',
            'estado' => 'required|in:Activo,Pagado,Vencido',
        ]);

        $prestamo = Prestamo::findOrFail($id);

        // Calcular el total a pagar con interés actualizado
        $total_pagar = $request->monto + ($request->monto * ($request->tasa_interes / 100));

        $prestamo->update([
            'monto' => $request->monto,
            'tasa_interes' => $request->tasa_interes,
            'total_pagar' => $total_pagar,
            'quincenas' => $request->quincenas,
            'saldo_pendiente' => $total_pagar,
            'fecha_inicio' => $request->fecha_inicio,
            'estado' => $request->estado,
        ]);

        return redirect()->route('prestamos.index')
            ->with('success', 'Préstamo actualizado correctamente.');
    }

    /**
     * Elimina un préstamo (solo si no tiene pagos registrados).
     */
    public function destroy($id)
    {
        $prestamo = Prestamo::findOrFail($id);

        if ($prestamo->abonos()->count() > 0) {
            return redirect()->route('prestamos.index')
                ->with('error', 'No se puede eliminar un préstamo con pagos registrados.');
        }

        $prestamo->delete();

        return redirect()->route('prestamos.index')
            ->with('success', 'Préstamo eliminado correctamente.');
    }

    /**
     * Muestra los socios para gestionar el prestamo.
     */
    public function listarSocios()
    {
        $socios = Socio::all(); // Obtener todos los socios
        return view('prestamos.socios', compact('socios'));
    }

    public function prestamosPorSocio($socio_id)
    {
        $socio = Socio::with('prestamos')->findOrFail($socio_id);
        return view('prestamos.socio', compact('socio'));
    }

}
