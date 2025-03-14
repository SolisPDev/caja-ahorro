<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Préstamos de {{ $socio->nombre }} {{ $socio->apellido_paterno }}</h2>
    </x-slot>

    <div class="max-w-6xl mx-auto py-6">
        <a href="{{ route('prestamos.socios') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
            ← Volver a la lista de socios
        </a>

        <table class="w-full bg-white shadow-lg rounded-lg mt-4">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2">Fecha Solicitud</th>
                    <th class="px-4 py-2">Monto</th>
                    <th class="px-4 py-2">Saldo Pendiente</th>
                    <th class="px-4 py-2">Estado</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($socio->prestamos as $prestamo)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $prestamo->fecha_solicitud }}</td>
                        <td class="px-4 py-2">${{ number_format($prestamo->monto, 2) }}</td>
                        <td class="px-4 py-2">${{ number_format($prestamo->saldo_pendiente, 2) }}</td>
                        <td class="px-4 py-2">{{ $prestamo->estado }}</td>
                        <td class="px-4 py-2 flex space-x-2">
                            <a href="{{ route('prestamos.edit', $prestamo->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Modifica</a>
                            <a href="{{ route('prestamos.show', $prestamo->id) }}" class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">Consulta</a>
                            <a href="{{ route('abonos.create', ['prestamo' => $prestamo->id]) }}" class="px-3 py-1 bg-purple-500 text-white rounded hover:bg-purple-600">Abonar</a>
                            <a href="{{ route('estado-cuenta.show', $prestamo->id) }}" class="px-3 py-1 bg-gray-700 text-white rounded hover:bg-gray-800">Estado de Cuenta</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if ($socio->prestamos->isEmpty())
            <p class="text-center text-gray-500 mt-4">Este socio no tiene préstamos registrados.</p>
        @endif
    </div>
</x-app-layout>
