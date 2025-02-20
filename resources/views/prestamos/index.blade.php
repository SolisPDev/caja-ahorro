<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Lista de Préstamos</h2>
    </x-slot>

    <div class="max-w-6xl mx-auto py-6">
        <div class="mb-4">
            <a href="{{ route('prestamos.socios') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                ← Volver a Prestamos
            </a>
        </div>

        <table class="w-full bg-white shadow-lg rounded-lg">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2">Socio</th>
                    <th class="px-4 py-2">Monto</th>
                    <th class="px-4 py-2">Saldo Pendiente</th>
                    <th class="px-4 py-2">Estado</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($prestamos as $prestamo)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $prestamo->socio->nombre }} {{ $prestamo->socio->apellido_paterno }}</td>
                        <td class="px-4 py-2 text-green-600 font-bold">$ {{ number_format($prestamo->monto, 2) }}</td>
                        <td class="px-4 py-2 text-red-600">$ {{ number_format($prestamo->saldo_pendiente, 2) }}</td>
                        <td class="px-4 py-2">{{ $prestamo->estado }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('prestamos.show', $prestamo->id) }}" class="text-blue-600">Ver</a> |
                            <a href="{{ route('prestamos.edit', $prestamo->id) }}" class="text-yellow-600">Editar</a> |
                            <form action="{{ route('prestamos.destroy', $prestamo->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600" onclick="return confirm('¿Seguro que deseas eliminar este préstamo?');">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if ($prestamos->isEmpty())
            <p class="text-center text-gray-500 mt-4">No hay préstamos registrados.</p>
        @endif
    </div>
</x-app-layout>
