<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Gestión de Préstamos</h2>
    </x-slot>

    <div class="max-w-6xl mx-auto py-6">
        <div class="mb-4 flex justify-between">
            <a href="{{ route('dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                ← Volver al Inicio
            </a>
            <div>
                <input type="text" id="search" placeholder="Buscar por Nombre o Apellido" 
                       class="px-4 py-2 border rounded-lg w-80" onkeyup="filterTable()">
            </div>
        </div>

        <table class="w-full bg-white shadow-lg rounded-lg">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Apellido Paterno</th>
                    <th class="px-4 py-2">Numero Cuenta</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody id="sociosTable">
                @foreach ($socios as $socio)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $socio->nombre }}</td>
                        <td class="px-4 py-2">{{ $socio->apellido_paterno }}</td>
                        <td class="px-4 py-2">{{ $socio->apellido_materno }}</td>
                        <td class="px-4 py-2 flex space-x-2">
                            <a href="{{ route('prestamos.create', $socio->id) }}" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                                Registro
                            </a>
                            <a href="{{ route('prestamos.edit', $socio->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                Modifica
                            </a>
                            <a href="{{ route('prestamos.show', $socio->id) }}" class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">
                                Consulta
                            </a>
                            
                            @if($socio->prestamos->isNotEmpty())
                                <a href="{{ route('abonos.create', ['prestamo' => $socio->prestamos->first()->id]) }}" 
                                class="px-3 py-1 bg-purple-500 text-white rounded hover:bg-purple-600">
                                    Abonar
                                </a>
                            @endif
                            
                            <a href="{{ route('estado-cuenta.show', $socio->id) }}" class="px-3 py-1 bg-gray-700 text-white rounded hover:bg-gray-800">
                                Estado Cuenta
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if ($socios->isEmpty())
            <p class="text-center text-gray-500 mt-4">No hay socios registrados.</p>
        @endif
    </div>

    <script>
        function filterTable() {
            let input = document.getElementById("search").value.toLowerCase();
            let rows = document.querySelectorAll("#sociosTable tr");

            rows.forEach(row => {
                let nombre = row.cells[0].textContent.toLowerCase();
                let apellido = row.cells[1].textContent.toLowerCase();
                if (nombre.includes(input) || apellido.includes(input)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }
    </script>
</x-app-layout>
