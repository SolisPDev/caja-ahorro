<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Lista de Socios</h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto">
        <div class="mb-4">
            <a href="{{ route('socios.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">
                Agregar Socio
            </a>
        </div>
    </div>
    <div class="flex max-w-6xl mx-auto">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <table class="min-w-full border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-4 py-2">#</th>
                        <th class="border px-4 py-2">Nombre</th>
                        <th class="border px-4 py-2">Apellido Paterno</th>
                        <th class="border px-4 py-2">Apellido Materno</th>
                        <th class="border px-4 py-2">Ahorro Total</th>
                        <th class="border px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($socios as $socio)
                        <tr>
                            <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-2">{{ $socio->nombre }}</td>
                            <td class="border px-4 py-2">{{ $socio->apellido_paterno }}</td>
                            <td class="border px-4 py-2">{{ $socio->apellido_materno }}</td>
                            <td class="border px-4 py-2">$ {{ number_format($socio->saldo_ahorro, 2) }}</td>
                            <td class="border px-4 py-2 flex space-x-2">
                                <a href="{{ route('socios.show', $socio) }}" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-green-700">Ver</a>
                                <a href="{{ route('socios.edit', $socio) }}" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Editar</a>
                                <a href="{{ route('aportaciones.socio', $socio->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Aportaciones</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if($socios->isEmpty())
                <p class="text-center text-gray-500 mt-4">No hay socios registrados.</p>
            @endif
        </div>
    </div>
</x-app-layout>
