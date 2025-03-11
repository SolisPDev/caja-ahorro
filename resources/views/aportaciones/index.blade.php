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
