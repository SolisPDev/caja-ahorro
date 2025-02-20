<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Aportaciones de {{ $socio->nombre }}
        </h2>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="mb-4 flex justify-between">
            <a href="{{ route('socios.index') }}" 
               class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                ← Volver a Socios
            </a>
            <a href="{{ route('aportaciones.create', $socio->id) }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Nueva Aportación 
            </a>
        </div>

        <table class="w-full bg-white shadow-lg rounded-lg">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2">Fecha</th>
                    <th class="px-4 py-2">Monto</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($aportaciones as $aportacion)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $aportacion->fecha_pago }}</td>
                        <td class="px-4 py-2 text-green-600 font-bold">$ {{ number_format($aportacion->monto, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if ($aportaciones->isEmpty())
            <p class="text-center text-gray-500 mt-4">No hay aportaciones registradas.</p>
        @endif
    </div>
</x-app-layout>
