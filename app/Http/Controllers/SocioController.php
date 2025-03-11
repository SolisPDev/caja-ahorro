<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Socio;
use App\Models\Abono;

class SocioController extends Controller
{

     

    // Mostrar el formulario para agregar un socio
    public function create()
    {
        return view('socios.create');
    }

    // Guardar un nuevo socio en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'string|max:255',
            'email' => 'email',
            'telefono' => 'string|max:15',
        ]);

        Socio::create([
            'nombre' => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'email' => $request->email,
            'telefono' => $request->telefono,
        ]);

        return redirect()->route('socios.index')->with('success', 'Socio agregado correctamente');
    }

    // Listar los socios
    public function index()
    {
        $socios = Socio::all();
        return view('socios.index', compact('socios'));
    }

    // Mostrar un socio específico
    public function show(Socio $socio)
    {
        return view('socios.show', compact('socio'));
    }

    // Mostrar formulario de edición
    public function edit(Socio $socio)
    {
        return view('socios.edit', compact('socio'));
    }

    // Actualizar los datos del socio
    public function update(Request $request, Socio $socio)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'string|max:255',
            'email' => 'required|email|unique:socios,email,' . $socio->id,
            'telefono' => 'required|string|max:15',
        ]);

        $socio->update($request->all());

        return redirect()->route('socios.index')->with('success', 'Socio actualizado correctamente');
    }

    // Eliminar un socio
    public function destroy(Socio $socio)
    {
        $socio->delete();

        return redirect()->route('socios.index')->with('success', 'Socio eliminado correctamente');
    }

    // filtra socios activos y permite busqueda por nombre o apellido paterno
    public function indexActivos(Request $request)
    {
        $query = Socio::where('activo', '1');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'like', "%$search%")
                  ->orWhere('apellido_paterno', 'like', "%$search%");
            });
        }

        $socios = $query->paginate(10);
        return view('socios.activos', compact('socios'));
    }

    public function adelantosActivos()
    {
        $socios = Socio::whereHas('adelantos', function ($query) {
            $query->where('activo', '1');
        })->get();

        return view('adelantos.activos', compact('socios'));
    }

    public function estadoCuenta($id)
    {
        $socio = Socio::findOrFail($id);
        $abonos = Abono::where('socio_id', $id)->orderBy('fecha', 'desc')->get();

        return view('socios.estadoCuenta', compact('socio', 'abonos'));
    }

    public function mostrarEstadoCuenta($socioId)
    {
        $socio = Socio::with(['prestamos', 'abonos'])->findOrFail($socioId);
        return view('socios.estado-cuenta', compact('socio'));
    }

    public function sociosPorEstado()
    {
        $socios = Socio::with('prestamos')->get()->map(function ($socio) {
            if ($socio->prestamos->isEmpty()) {
                $socio->estado_prestamo = 'Sin préstamos';
            } elseif ($socio->prestamos->where('estado', 'Activo')->isNotEmpty()) {
                $socio->estado_prestamo = 'Con préstamo activo';
            } else {
                $socio->estado_prestamo = 'Con préstamos pagados';
            }
            return $socio;
        });
        return view('socios.estadoPrestamo', compact('socios'));
    }

    public function historialPrestamo($socioId)
    {
        $socio = Socio::findOrFail($socioId);

        // Buscar el préstamo activo o el último préstamo pagado
        $prestamo = $socio->prestamos()->orderBy('created_at', 'desc')->first();

        // Si hay préstamo, obtener sus pagos
        $pagos = $prestamo ? $prestamo->abonos()->orderBy('fecha', 'asc')->get(['monto', 'fecha']) : [];

        return response()->json([
            'prestamo' => $prestamo ? [
                'monto' => $prestamo->monto,
                'estado' => $prestamo->estado
            ] : null,
            'pagos' => $pagos
        ]);
    }
}
