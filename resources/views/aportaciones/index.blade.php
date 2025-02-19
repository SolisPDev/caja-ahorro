<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Aportaciones</h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto">
        <div class="mb-4">
            <a href="{{ route('aportaciones.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">
                Registrar Aportación
            </a>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <table class="min-w-full border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-4 py-2">#</th>
                        <th class="border px-4 py-2">Socio</th>
                        <th class="border px-4 py-2">Monto</th>
                        <th class="border px-4 py-2">Fecha</th>
                        <th class="border px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($aportaciones as $aportacion)
                        <tr>
                            <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-2">{{ $aportacion->socio->nombre }}</td>
                            <td class="border px-4 py-2">${{ number_format($aportacion->monto, 2) }}</td>
                            <td class="border px-4 py-2">{{ $aportacion->fecha_pago }}</td>
                            <td class="border px-4 py-2 flex space-x-2">
                                <a href="{{ route('aportaciones.show', $aportacion) }}" class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">Ver</a>
                                <a href="{{ route('aportaciones.edit', $aportacion) }}" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Editar</a>
                                <form action="{{ route('aportaciones.destroy', $aportacion) }}" method="POST" onsubmit="return confirm('¿Eliminar esta aportación?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if($aportaciones->isEmpty())
                <p class="text-center text-gray-500 mt-4">No hay aportaciones registradas.</p>
            @endif
        </div>
    </div>
</x-app-layout>
