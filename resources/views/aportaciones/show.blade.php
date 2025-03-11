<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Detalles de la Aportación</h2>
    </x-slot>

    <div class="py-6 max-w-lg mx-auto">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-lg font-bold mb-4 text-gray-800">Información de la Aportación</h3>
            <p><strong>Numero Cuenta:</strong> {{ $aportacion->socio->apellido_materno  ?? 'Sin Cuenta asignada' }}</p>
            <p><strong>Socio:</strong> {{ $aportacion->socio->nombre  ?? 'Sin socio asignado' }}</p>
            <p><strong>Monto:</strong> ${{ number_format($aportacion->monto, 2) }}</p>
            <p><strong>Fecha:</strong> {{ $aportacion->fecha_pago }}</p>

            <div class="flex justify-between mt-6">
                <a href="{{ route('aportaciones.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg shadow hover:bg-gray-700">
                    Regresar
                </a>
                <a href="{{ route('aportaciones.edit', $aportacion) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-lg shadow hover:bg-yellow-600">
                    Editar
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
