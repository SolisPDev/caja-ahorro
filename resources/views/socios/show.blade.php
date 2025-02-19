<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Detalles del Socio</h2>
    </x-slot>

    <div class="py-6 max-w-lg mx-auto">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-lg font-bold mb-4 text-gray-800">Información del Socio</h3>
            <div class="mb-4">
                <strong>Nombre(s):</strong>
                <p class="text-gray-700">{{ $socio->nombre }}</p>
            </div>
            <div class="mb-4">
                <strong>Apellido Paterno:</strong>
                <p class="text-gray-700">{{ $socio->apellido_paterno }}</p>
            </div>
            <div class="mb-4">
                <strong>Apellido Materno:</strong>
                <p class="text-gray-700">{{ $socio->apellido_materno }}</p>
            </div>
            <div class="mb-4">
                <strong>Correo Electrónico:</strong>
                <p class="text-gray-700">{{ $socio->email }}</p>
            </div>
            <div class="mb-4">
                <strong>Teléfono:</strong>
                <p class="text-gray-700">{{ $socio->telefono }}</p>
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('socios.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-gray-700">
                    Regresar
                </a>
                <a href="{{ route('socios.edit', $socio) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-lg shadow hover:bg-yellow-600">
                    Editar
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
