<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Socios Activos</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="flex justify-between mb-4">
                <!-- Formulario de búsqueda -->
                <form method="GET" action="{{ route('socios.activos') }}" class="flex space-x-2">
                    <input type="text" name="search" placeholder="Buscar por nombre o apellido"
                        class="border rounded-lg px-3 py-2 w-full sm:w-64"
                        value="{{ request('search') }}">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Buscar</button>
                </form>
            </div>

            <!-- Tabla de Socios Activos -->
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2">ID</th>
                            <th class="border border-gray-300 px-4 py-2">Nombre</th>
                            <th class="border border-gray-300 px-4 py-2">Apellido Paterno</th>
                            <th class="border border-gray-300 px-4 py-2">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($socios as $socio)
                            <tr class="border border-gray-300">
                                <td class="border border-gray-300 px-4 py-2">{{ $socio->id }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $socio->nombre }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $socio->apellido_paterno }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <a href="{{ route('adelantos.create', $socio->id) }}"
                                        class="bg-green-500 text-white px-4 py-2 rounded-lg">Solicitar</a>
                                    <a href="{{ route('adelantos.create', $socio->id) }}"
                                        class="bg-green-500 text-white px-4 py-2 rounded-lg">Estado Cuenta</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="mt-4">
                {{ $socios->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
