<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Estado de Cuenta</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-lg font-semibold">Información del Socio</h3>
            <p><strong>Nombre:</strong> {{ $socio->nombre }} {{ $socio->apellido_paterno }}</p>
            <p><strong>ID del Socio:</strong> {{ $socio->id }}</p>

            <h3 class="mt-4 text-lg font-semibold">Préstamos Activos</h3>
            <table class="w-full bg-white shadow-lg rounded-lg mt-2">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2">Monto</th>
                        <th class="px-4 py-2">Saldo Pendiente</th>
                        <th class="px-4 py-2">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($socio->prestamos as $prestamo)
                        <tr class="border-b">
                            <td class="px-4 py-2">$ {{ number_format($prestamo->monto, 2) }}</td>
                            <td class="px-4 py-2">$ {{ number_format($prestamo->saldo_pendiente, 2) }}</td>
                            <td class="px-4 py-2">{{ $prestamo->estado }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h3 class="mt-4 text-lg font-semibold">Pagos Realizados</h3>
            <table class="w-full bg-white shadow-lg rounded-lg mt-2">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2">Fecha</th>
                        <th class="px-4 py-2">Monto</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($socio->pagos && $socio->pagos->isNotEmpty())
                        @foreach ($socio->pagos as $pago)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $pago->fecha_pago }}</td>
                                <td class="px-4 py-2 text-green-600 font-bold">$ {{ number_format($pago->monto, 2) }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="2" class="text-center text-gray-500 py-2">No hay pagos registrados.</td>
                        </tr>
                    @endif        
                </tbody>
            </table>

            <div class="mt-6">
                <a href="{{ route('socios.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Regresar</a>
            </div>
        </div>
    </div>
</x-app-layout>
