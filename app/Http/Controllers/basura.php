public function store(Request $request, $adelanto_id)
    {
        $request->validate([
            'monto' => 'required|numeric|min:1',
        ]);

        $adelanto = Adelanto::findOrFail($adelanto_id);
        $socio = $adelanto->socio;

        // Verifica que el abono no supere el saldo pendiente
        if ($request->monto > $adelanto->saldo_pendiente) {
            return redirect()->back()->with('error', 'El monto del abono no puede superar el saldo pendiente.');
        }

        // Registrar el abono
        $nuevoSaldo = $adelanto->saldo_pendiente - $request->monto;
        $abono = Abono::create([
            'socio_id' => $socio->id,
            'adelanto_id' => $adelanto->id,
            'fecha' => now(),
            'monto' => $request->monto,
            'saldo_restante' => $nuevoSaldo,
        ]);

        // Actualizar el saldo pendiente del adelanto
        $adelanto->update(['saldo_pendiente' => $nuevoSaldo]);

        // Si el saldo pendiente llega a 0, marcar el adelanto como liquidado
        if ($nuevoSaldo <= 0) {
            $adelanto->update(['estatus' => 'LIQUIDADO']);
        }

        return redirect()->route('abonos.index', $socio->id)
                         ->with('success', 'Abono registrado correctamente.');
    }