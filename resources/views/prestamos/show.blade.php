<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Detalles del Préstamo</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-lg font-semibold">Información del Préstamo</h3>
            <p><strong>Socio:</strong> {{ $prestamo->socio->nombre }} {{ $prestamo->socio->apellido_paterno }}</p>
            <p><strong>Monto:</strong> ${{ number_format($prestamo->monto, 2) }}</p>
            <p><strong>Tasa de Interés:</strong> {{ $prestamo->tasa_interes }}%</p>
            <p><strong>Saldo Pendiente:</strong> ${{ number_format($prestamo->saldo_pendiente, 2) }}</p>
            <p><strong>Estado:</strong> {{ $prestamo->estado }}</p>
            <p><strong>Fecha de Solicitud:</strong> {{ $prestamo->fecha_solicitud }}</p>

            <h3 class="mt-4 text-lg font-semibold">Pagos Realizados</h3>
            <table class="w-full bg-white shadow-lg rounded-lg mt-2">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2">Fecha</th>
                        <th class="px-4 py-2">Monto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prestamo->pagos as $pago)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $pago->fecha_pago }}</td>
                            <td class="px-4 py-2 text-green-600 font-bold">$ {{ number_format($pago->monto, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            @if ($prestamo->pagos->isEmpty())
                <p class="text-center text-gray-500 mt-4">No hay pagos registrados.</p>
            @endif

            <div class="mt-6">
                <a href="{{ route('prestamos.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Regresar</a>
            </div>
        </div>
    </div>
</x-app-layout>
