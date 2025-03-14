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
                        <td class="px-4 py-2">
                            <a href="{{ route('prestamos.socio', $socio->id) }}" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                                Ver Préstamos
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
