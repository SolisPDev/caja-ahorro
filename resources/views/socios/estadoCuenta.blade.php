<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Estado de Cuenta</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-lg font-bold mb-4">Socio: {{ $socio->nombre }} {{ $socio->apellido_paterno }}</h3>

            {{-- Saldo Actual --}}
            <div class="mb-4 p-4 bg-gray-100 rounded-lg">
                <strong>Saldo Pendiente:</strong>
                <span class="text-red-500">$ {{ number_format($socio->adelantos->sum('saldo_pendiente'), 2) }}</span>
            </div>

            {{-- Tabla de Abonos --}}
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-2">Fecha</th>
                            <th class="px-4 py-2">Monto Abonado</th>
                            <th class="px-4 py-2">Saldo Restante</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($abonos as $abono)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $abono->fecha }}</td>
                                <td class="px-4 py-2 text-green-500">$ {{ number_format($abono->monto, 2) }}</td>
                                <td class="px-4 py-2 text-red-500">$ {{ number_format($abono->saldo_restante, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Botón de Regreso --}}
            <div class="mt-4 text-center">
                <a href="{{ route('adelantos.activos') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg">
                    Regresar
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
